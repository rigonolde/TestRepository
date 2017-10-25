<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/Lib/Routing/ManagerRouting.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/Manager/DB.php');

// TEST DE LA BASE DE DONNEES
new \Manager\DB();
//FIN

$url = $_SERVER['REQUEST_URI'];
$url = explode("?", $url)[0];
$routingManager = new Lib\Routing\ManagerRouting();
$routingManager->getRoutes($url);
?>
