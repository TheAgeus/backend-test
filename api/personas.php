<?php
header('Content-Type: application/json');

require("../modelos/Persona.php");
require("../modelos/Usuario.php");

use Modelos\Persona;
use Modelos\Usuario;

$headers = getallheaders();

if(empty($headers['Authorization'])) {
  echo json_encode(array(
    'estatus' => 500,
    'mensaje' => 'Usted no esta autenticado'
  ));
  exit();
}
else {
  // tengo que buscar si ese token de verdad existe
  $mytoken = $headers['Authorization'];
  $res = json_decode(Usuario::token($mytoken), true);

  // Tratar de capturar una persona
  if (!empty($_POST['nombre']) && !empty($_POST['edad']) && !empty($res)) { // POST ADD PERSONA
    echo Persona::capturar($mytoken, $_POST['nombre'], $_POST['edad']); 
  }

  elseif ($_SERVER['REQUEST_METHOD'] == 'GET') { // PARA OBTENER TODAS LAS PERSONAS GET ALL PERSONAS
    if ($res['rol'] == 'admin') {
      echo Persona::all();
    }
    else {
      echo json_encode(array(
        'estatus' => 500,
        'mensaje' => 'Usted no puede entrar ahí'
      ));
    }
  }
}


?>