<?php
require('dbHandler.php');
$json = file_get_contents('php://input');
$data = json_decode($json);

$handler = new dbControl();
$query = "INSERT INTO test(texto) VALUES('$data->nombre')";

$id = $handler->insert($query);

$data = new obj(true);
$data->id = $id;
echo json_encode($data);
