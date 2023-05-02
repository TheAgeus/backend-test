<?php

header('Content-Type: application/json');
session_start();

require("../modelos/Usuario.php");

use Modelos\Usuario;

if (!empty($_POST['user']) && !empty($_POST['pass'])) {
    $res = Usuario::login($_POST['user'], $_POST['pass']);
    $json_arr = json_decode($res, true);
    if( !empty( $json_arr['token'] ) ) {
        $_SESSION['token'] = $json_arr['token'];
        $_SESSION['rol'] = $json_arr['rol'];
    }
    echo $res;
    exit();
}

else {
    echo json_encode(array(
        'estatus' => 404,
        'mensaje' => 'Faltan datos'
    ));
    exit();
}

?>