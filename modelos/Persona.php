<?php

namespace Modelos;
use mysqli;

$conn = NULL;
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'personas');
define('DB_PORT', '3306');


class Persona {
  static function all() {
    try 
    {
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
      $conn->set_charset("utf8");

      $sql = "SELECT * FROM personas";
      $result = $conn->query($sql);
      $personas = array();
      if ($result->num_rows > 0) {
        // Agregar los datos de cada registro al arreglo de personas
        while($row = $result->fetch_assoc()) {
          $personas[] = $row;
        }
        $conn->close();
        return json_encode(array(
          'estatus' => 200,
          'mensaje' => 'personas encontradas',
          'data' => $personas
        ));
      }
      else {
        return json_encode(array(
          'estatus' => 404,
          'mensaje' => 'personas no encontradas',
          'data' => $personas
        ));
      }

    } 
    catch (Exception $e) 
    {
      return json_decode(array(
        'estatus' => 500,
        'mensaje' => $e
      ));
    }
    return json_encode($arr);
  }
}

?>