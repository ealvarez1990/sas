<?php

class ManejadorArchivos {

    public static function trocea($valor, $puntoCorte) {
        return substr($valor, 0, strpos($valor, $puntoCorte));
    }

    public static function obtenerCategoria($valor) {
        $cadena = substr($valor, strripos($valor, "_X_"));
        $trimmed = trim($cadena, "_X_");
        return self::trocea($trimmed, "_T_");
    }

    public static function obtenerUsuario($valor) {
        $cadena = substr($valor, strripos($valor, "_U_"));
        $trimmed = trim($cadena, "_U_");
        return self::trocea($trimmed, "_X_");
    }

    public static function obtenerTituloCancion($valor, $extension) {
        if (substr($valor, -4) == $extension) {
            $cadena = substr($valor, strripos($valor, "_C_"));
            return $trimmed = trim($cadena, "_C_");
        }
    }

    public static function obtenerTituloCancionSinExtension($valor, $extension) {
        if (substr($valor, -4) == $extension) {
            $cadena = substr($valor, strripos($valor, "_C_"));
            $trimmed = trim($cadena, "_C_");
            return $rest = substr($trimmed, 0, -4);
        }
    }

    public static function nombreCancionImagen($valor,$extensionimagen) {
        $cadena = self::obtenerTituloCancionSinExtension($valor, $extensionimagen);
        return self::trocea($cadena, "_P_");
    }

    public static function obtenerExtension($valor) {
        return substr($valor, -4);
    }

    public static function obtenerPrivacidad($valor) {
        $cadena = substr($valor, strripos($valor, "_T_"));
        $trimmed = trim($cadena, "_T_");
        return self::trocea($trimmed, "_C_");
    }

    public static function obtenerPortada($valor) {
        $usuario = self::obtenerUsuario($valor);
        $categoria = self::obtenerCategoria($valor);
        $tituloOriginal = self::obtenerTituloCancion($valor, $extension);

        if (self::obtenerExtension($valor) == ".png" || self::obtenerExtension($valor) == ".jpg" || self::obtenerExtension($valor) == ".jpeg") {
            return $valor;
        }
    }

}
