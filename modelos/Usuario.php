<?php

namespace Modelos;
use mysqli;

$conn = NULL;
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'personas');
define('DB_PORT', '3306');

class Usuario {
    static function login($user, $password) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
            $conn->set_charset("utf8");
    
            // Buscar el usuario y contraseña
            // Si se encuentra
            // Generar un token nuevo en la tabla tokens
            // Devolver el token creado y el rol
        }
        catch (Exception $e) {

        }
    }
}

?>