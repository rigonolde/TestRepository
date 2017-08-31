<?php

require_once('../Manager/DBManager.php');
require_once('../DBM/category.php');

function deleteAction()
{
    $id = $_GET["id"];
    $category = new \DBM\Category();
    $category->setId($id);
    $dbManager = new \Manager\DBManager();
    $dbManager->delete($category);
    echo json_encode($dbManager->getResponse());
}

function editAction()
{
    $category = new \DBM\Category();
    $category->setParentId($_POST["parentId"]);
    $category->setLibelle($_POST["libelle"]);
    $category->setDescription($_POST["description"]);
    $dbManager = new \Manager\DBManager();
    $dbManager->insert($category);
    echo json_encode($dbManager->getResponse());
}

function addAction($id)
{
    $category = new \DBM\Category();
    $category->setId($_POST["id"]);
    $category->setParentId($_POST["parentId"]);
    $category->setLibelle($_POST["libelle"]);
    $category->setDescription($_POST["description"]);
    $dbManager = new \Manager\DBManager();
    $dbManager->insert($category);
    echo json_encode($dbManager->getResponse());
}
