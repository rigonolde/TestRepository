<!DOCTYPE html>
<?php
require_once('/Lib/Routing/ManagerRouting.php');

$url = $_SERVER['REQUEST_URI'];
$url = explode("?", $url)[0];
$routingManager = new Lib\Routing\ManagerRouting();
$routingManager->getRoutes($url);
?>
