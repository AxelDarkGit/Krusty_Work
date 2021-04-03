<?php
require('dbHandler.php');
$json = file_get_contents('php://input');
$data = json_decode($json);

$handler = new dbControl();

// Building query with the provided json data
$count = 0;
$query = "UPDATE ".$data->tblName." SET "; // Beginning of query with table name from json
    foreach($data as $key => $val){
        if($count > 1)
            $query .= $key."='".$val."',"; //columna1='valor1',columna2='valor2',
        $count++;
    }
    $query = rtrim($query, ",");            
$count = 0;
$query .= " WHERE ";                       // Middle of query, closing columns, adding values
    foreach($data as $key => $val){
        if($count == 1)
            $query .= $key."='".$val."'";  //columna1='valor1',columna2='valor2',
        $count++;
    }

$id = $handler->insert($query);

$data = new obj(true);
$data->id = $id;
echo json_encode($data);
