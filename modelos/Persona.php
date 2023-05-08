<?php

namespace Modelos;
use mysqli;

$conn = NULL;
if (!defined('DB_HOST')) {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'personas');
  define('DB_PORT', '3306');
}


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

  static function capturar($token, $nombre, $edad) {
    try {
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
      $conn->set_charset("utf8");

      $res = NULL;

      $stmt = mysqli_prepare($conn, "CALL insertPerson(?, ?, ?)");
      mysqli_stmt_bind_param($stmt, "sss", $token, $nombre, $edad);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $res);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);

      if (!$res) {
        return json_encode(array(
          'estatus' => 404,
          'mensaje' => 'Credenciales incorrectas'
        ));
      }
      else {
        return json_encode(array(
          'estatus' => 200,
          'mensaje' => 'Persona agregada con estatus CAPTURADO',
        ));
      }
    }
    catch(Exception $e) {
      return json_encode(array(
        'estatus' => 500,
        'mensaje' => 'Hubo un error en el servidor'
      ));
    }
  }
}

?>