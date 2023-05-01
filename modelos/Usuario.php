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
    
            $p_rol = NULL;
            $p_token = NULL;

            $stmt = mysqli_prepare($conn, "CALL buscar_usuario_y_contraseña(?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $user, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $p_rol, $p_token);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            if (empty($p_rol)) {
                return json_encode(array(
                    'estatus' => 404,
                    'mensaje' => 'Usuario o contraseña incorrectos'
                ));
            }
            else {
                return json_encode(array(
                    'estatus' => 200,
                    'mensaje' => 'Credenciales correctas',
                    'token' => $p_token,
                    'rol' => $p_rol
                ));
            }
        }
        catch (Exception $e) {
            return json_encode(array(
                'estatus' => 500,
                'mensaje' => 'Hubo un error en el servidor'
            ));
        }
    }

    static function logout($token) {
        
    }
}

?>