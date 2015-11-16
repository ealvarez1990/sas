<?php

/**
 * Description of FileUpload
 *
 * @author Usuario
 */
class FileUpload {
    /*
     * Queda pendiente crear una variable nombre auxiliar para renombrar los ficheros existentes.
     */

    const RENAME = 0, NOTOUCH = 1, UPDATE = 2;

    private $store = "./", $name, $size = 100000, $parametro = NULL, $policy = self::RENAME, $operations = false;
    private $extension;
    private $types = array(
        'jpg' => 1,
        'gif' => 1,
        'png' => 1,
        'jpeg' => 1,
        'mp3' => 1
    );

    function __construct($param) {
        if (isset($_FILES[$param])) {
            $this->parametro = $_FILES[$param];
            if (!is_array($this->parametro['name'])) {
                if ($this->parametro['name'] != '') {
                    //pathinfo devuelve un array asociativo con extension, dirname, basename, filename
                    $this->extension = pathinfo($this->parametro['name'])['extension'];
                    $this->name = pathinfo($this->parametro['name'])['filename'];
                }
            } else {
                $this->parametro = $this->revertArray();
                for ($i = 0; $i < count($this->parametro); $i++) {
                    if ($this->parametro[$i]['name'] != '') {
                        $this->extension[$i] = pathinfo($this->parametro[$i]['name'])['extension'];
                        $this->name[$i] = pathinfo($this->parametro[$i]['name'])['filename'];
                    }
                }
            }
            $this->operations = true;
        }
    }

    private function limitSize($param) {
        return $param['size'] <= $this->size;
    }

    private function checkDirectory() {
        if (!is_dir($this->store) || substr($this->store, -1) != '/') {
            return mkdir($this->store . $this->name);
        }
        return true;
    }

    private function policy($pos = NULL) {
        switch ($this->policy) {
            case self::NOTOUCH:
                if ($pos !== NULL) {
                    if (file_exists($this->store . $this->name[$pos] . $this->extension[$pos])) {
                        return false;
                    }
                }
                if (file_exists($this->store . $this->name . $this->extension)) {
                    return false;
                }
                break;
            case self::RENAME:
                $c = 1;
                if ($pos !== NULL) {
                    while (file_exists($this->store . $this->name[$pos] . '.' . $this->extension[$pos])) {
                        $this->name[$pos] .= '_' . $c;
                        $c++;
                    }
                } else {
                    while (file_exists($this->store . $this->name . '.' . $this->extension)) {
                        $this->name .= '_' . $c;
                        $c++;
                    }
                }
        }
        return true;
    }

    public function addType($param) {
        if (!$this->isOnType($param)) {
            $this->types[$param] = 1;
            return true;
        }
        return false;
    }

    public function removeType($param) {
        if ($this->isOnType($param)) {
            unset($this->types[$param]);
            return true;
        }
        return false;
    }

    public function isOnType($param) {
        return isset($this->types[$param]);
    }

    function getStore() {
        return $this->store;
    }

    function getName() {
        return $this->name;
    }

    function getSize() {
        return $this->size;
    }

    function setStore($store) {
        $this->store = $store;
    }

    public function getPolicy() {
        return $this->policy;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSize($size) {
        $this->size = $size;
    }

    function setPolicy($param) {
        $this->policy = $param;
    }

    function upload() {
        if ($this->operations) {
            if (!is_array($this->extension)) {
                $this->uploadSingle();
            }
            $this->uploadMultiple();
        }
        return false;
    }

    private function uploadSingle() {
        if ($this->parametro['error'] == UPLOAD_ERR_OK) {
            if ($this->isOnType($this->extension)) {
                if ($this->limitSize($this->parametro)) {
                    if ($this->policy(NULL)) {
                        return move_uploaded_file($this->parametro["tmp_name"], $this->store . $this->name . '.' . $this->extension);
                    }
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        } else {
            return $this->parametro['parametro'];
        }
    }

    private function uploadMultiple() {
        for ($i = 0; $i < count($this->parametro); $i++) {
            if ($this->parametro[$i]['error'] == UPLOAD_ERR_OK) {
                if ($this->isOnType($this->extension[$i])) {
                    if ($this->limitSize($this->parametro[$i])) {
                        if ($this->policy($i)) {
                            move_uploaded_file($this->parametro[$i]["tmp_name"], $this->store . $this->name[$i] . '.' . $this->extension[$i]);
                        }
                    } else {
                        //return -1;
                    }
                } else {
                    //return -2;
                }
            } else {
                //return $this->parametro['parametro'];
            }
        }
    }

    private function revertArray() {
        $array = array();

        foreach ($this->parametro as $key => $value) {
            foreach ($this->parametro[$key] as $index => $c) {
                $array[$index][$key] = $c;
            }
        }
        return$array;
    }

}
