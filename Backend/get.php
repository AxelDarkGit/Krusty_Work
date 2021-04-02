<?php
//Incluye la clase RequestHandler
require('RequestHandler.php');
$json = file_get_contents('php://input');
$tblName = json_decode($json);

//nueva request que hace get a la URL
$handler = new requestHandler();
$data = $handler->getRequest("http://localhost/Dist/Krusty_Work/BD/getvalues.php?table=".$tblName->{"tblName"});
echo $data;
