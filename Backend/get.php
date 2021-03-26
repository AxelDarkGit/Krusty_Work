<?php
//Incluye la clase RequestHandler
require('RequestHandler.php');

//nueva request que hace get a la URL
$handler = new requestHandler();
$data = $handler->getRequest("http://localhost/Dist/BD/getvalues.php");
echo $data;
