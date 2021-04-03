<?php
require('dbHandler.php');
$json = file_get_contents('php://input');
$data = json_decode($json);

$handler = new dbControl();
//post y postvalues son para insertar registros en una tabla.
// Building query with the provided json data
$count = 0;
$query = "INSERT INTO ".$data->tblName."("; // Beginning of query with table name from json
    foreach($data as $key => $val){
        if($count <> 0)
            $query .= $key.",";             //columna1,columna2,
        $count++;
    }
    $query = rtrim($query, ",");            
$count = 0;
$query .= ") VALUES(";                      // Middle of query, closing columns, adding values
    foreach($data as $key => $val){
        if($count <> 0)
            $query .= "'".$val."',";        //'valor1','valor2',
        $count++;
    }
    $query = rtrim($query, ",");            
$query .= ")";                              // End of query closing ')'

$id = $handler->insert($query);

$data = new obj(true);
$data->id = $id;
echo json_encode($data);
