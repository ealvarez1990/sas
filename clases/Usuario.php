<?php

class Usuario {

    private $nombre,
            $apellidos,
            $clave,
            $login,
            $correo,
            $alias,
            $fechaNac,
            $fechaAlta,
            $sexo,
            $rol,
            $admin,
            $activo;

    function __construct($login=NULL, $nombre=NULL, $clave=NULL,$apellidos=NULL,  $correo=NULL, $alias=NULL, $fechaNac=NULL, $fechaAlta=NULL, $sexo=NULL, $rol=NULL, $admin=NULL, $activo=NULL) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->clave = $clave;
        $this->correo = $correo;
        $this->alias = $alias;
        $this->login = $login;
        $this->fechaNac = $fechaNac;
        $this->fechaAlta = $fechaAlta;
        $this->sexo = $sexo;
        $this->rol = $rol;
        $this->admin = $admin;
        $this->activo = $activo;
    }

    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getClave() {
        return $this->clave;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getAlias() {
        return $this->alias;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getRol() {
        return $this->rol;
    }

    function getAdmin() {
        return $this->admin;
    }

    function getActivo() {
        return $this->activo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setAlias($alias) {
        $this->alias = $alias;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setAdmin($admin) {
        $this->admin = $admin;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    public function __toString() {
        return $this->login;
    }

    public function getJSON() {
        $prop = get_object_vars($this);
        $resp = '{';
        foreach ($prop as $key => $value) {
            $resp .= '"' . $key . '":' . json_encode(htmlspecialchars_decode($value)) . ',';
        }
        $resp = substr($resp, 0, -1) . "}";
        return $resp;
    }

}
