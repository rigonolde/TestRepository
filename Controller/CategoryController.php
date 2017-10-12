<?php

namespace Controller;

require_once("Lib/MoteurTemplate/RenderTamplate.php");
require_once('DBM/category.php');
require_once('Manager/DBManager.php');

Class CategoryController extends \Lib\MoteurTemplate\RenderTamplate
{

    public function deleteAction($id)
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'GET') {
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
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new \DBM\Category();
            $category->setId($id);
            $parentId = (!isset($_POST["parentId"]) || $_POST["parentId"] == 0) ? null : $_POST["parentId"];
            $category->setParentId($parentId);
            $category->setLibelle(isset($_POST["libelle"]) ? $_POST["libelle"] : null);
            $category->setDescription(isset($_POST["description"]) ? $_POST["description"] : null);
            $dbManager = new \Manager\DBManager();
            $dbManager->update($category);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function addAction()
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new \DBM\Category();
            $parentId = (!isset($_POST["parentId"]) || $_POST["parentId"] == 0) ? null : $_POST["parentId"];
            $category->setParentId($parentId);
            $category->setLibelle(isset($_POST["libelle"]) ? $_POST["libelle"] : null);
            $category->setDescription(isset($_POST["description"]) ? $_POST["description"] : null);
            $dbManager = new \Manager\DBManager();
            $dbManager->insert($category);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function listAction()
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $dbManager = new \Manager\DBManager();
            $param = array();
            if (isset($_GET["id"])) {
                $param[] = "id=" . $_GET["id"];
            }
            $dbManager->queryCategory($param);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

}
