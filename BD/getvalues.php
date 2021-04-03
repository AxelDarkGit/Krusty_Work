<?php
require('dbHandler.php');

$query = "SELECT * FROM ".$_GET["table"];
$handler = new dbControl();
$results = $handler->fetchAll($query);



$values = new obj(true);
$values->data = $results;

echo (json_encode($values));
