<?php
require('dbHandler.php');
//get y getvalues php son para leer los registros de una tabla.
$query = "SELECT * FROM ".$_GET["table"];
$handler = new dbControl();
$results = $handler->fetchAll($query);



$values = new obj(true);
$values->data = $results;

echo (json_encode($values));
