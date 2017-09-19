<?php

namespace Controller;

require_once("Lib/MoteurTemplate/RenderTamplate.php");
require_once('DBM/category.php');
require_once('Manager/DBManager.php');

Class CategoryController extends \Lib\MoteurTemplate\RenderTamplate
{

    public function deleteAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $category = new \DBM\Category();
            $category->setId((int) $id);
            $dbManager = new \Manager\DBManager();
            $dbManager->delete($category);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function editAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new \DBM\Category();
            $category->setId($id);
            $category->setParentId($_POST["parentId"]);
            $category->setLibelle($_POST["libelle"]);
            $category->setDescription($_POST["description"]);
            $dbManager = new \Manager\DBManager();
            $dbManager->update($category);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function addAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new \DBM\Category();
            $category->setId($_POST["id"]);
            $category->setParentId($_POST["parentId"]);
            $category->setLibelle($_POST["libelle"]);
            $category->setDescription($_POST["description"]);
            $dbManager = new \Manager\DBManager();
            $dbManager->insert($category);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function listAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $dbManager = new \Manager\DBManager();
            $param = array();
//            $param[] = "parent_id is null";
            $dbManager->queryCategory($param);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

}
