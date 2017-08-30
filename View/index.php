<?php require_once('../Manager/CategoryManager.php'); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $ca = new Manager\CategoryManager();
        $ca->getAllCategory();
        ?>
    </body>
</html>
