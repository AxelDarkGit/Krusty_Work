<?php
//Incluye la clase RequestHandler
require('RequestHandler.php');

//consigue el body de la peticion y se la asigna a data
$json = file_get_contents('php://input');
$data = json_decode($json);

//nueva request que hace POST a la URL pasandole data con data
$handler = new requestHandler();
$values = $handler->postRequest("http://localhost/Dist/Krusty_Work/BD/postvalues.php", $data);

echo $values;
