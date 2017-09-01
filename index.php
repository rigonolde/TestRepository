<!DOCTYPE html>
<?php
require_once('/Lib/Routing/ManagerRouting.php');

$url = $_SERVER['REQUEST_URI'];
$routingManager = new Lib\Routing\ManagerRouting();
$routingManager->getRoutes($url);
?>
