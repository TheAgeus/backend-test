<?php
header('Content-Type: application/json');
require("../modelos/Usuario.php");
use Modelos\Usuario;

if (!empty($_POST['user']) && !empty($_POST['pass'])) {
    echo Usuario::login($_POST['user'], $_POST['pass']);
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