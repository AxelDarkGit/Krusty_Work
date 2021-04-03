<?php
require('dbHandler.php');
$json = file_get_contents('php://input');
$data = json_decode($json);

$handler = new dbControl();
$query = "INSERT INTO reinicio_contra(reinicio_correo, reinicio_token) VALUES('$data->reinicio_correo', '$data->reinicio_token')";

$id = $handler->insert($query);

$data = new obj(true);
$data->id = $id;
echo json_encode($data);
