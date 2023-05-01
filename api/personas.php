<?php
header('Content-Type: application/json');
require("../modelos/Persona.php");
use Modelos\Persona;

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

}

echo Persona::all();

?>