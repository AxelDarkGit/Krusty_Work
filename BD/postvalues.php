<?php
require('dbHandler.php');
$json = file_get_contents('php://input');
$data = json_decode($json);

$handler = new dbControl();
// $query = "INSERT INTO test(texto) VALUES('$data->nombre')";

$query = "SELECT usuario_correo FROM usuario WHERE usuario_correo='$data->correo'";

$result = $handler->fetchAll($query);

$data = new obj(true);
$data->result = $result;
echo json_encode($data);
