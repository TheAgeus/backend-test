<?php
header('Content-Type: application/json');

if (empty($_GET['login']) && empty($_GET['logout'])) {
    echo json_encode(array(
        'estatus' => 404,
        'mensaje' => 'No se encuentra esa ruta'
    ));
    exit();
}


if (!empty($_GET['login'])) {
    echo json_encode(array(
        'estatus' => 200,
        'mensaje' => 'Hola, desde el login'
    ));
    exit();
}

if (!empty($_GET['logout'])) {
    echo json_encode(array(
        'estatus' => 200,
        'mensaje' => 'Hola, desde el logout'
    ));
    exit();
}



?>