<?php
//Incluye la clase RequestHandler
require('RequestHandler.php');

//consigue el body de la peticion y se la asigna a data
$json = file_get_contents('php://input');
$data = json_decode($json);

//nueva request que hace POST a la URL pasandole data con data
$handler = new requestHandler();
$values = $handler->postRequest("http://localhost/Dist/Krusty_Work/BD/postvalues.php", $data);

//recuerda hacer json_decode en caso de que necesites insertar otro dato
$values = json_decode($values);

if ($values->state === true) {
  //otro insert
  $response = new obj(true);
  echo json_encode($response);
} else {
  echo $values;
}
