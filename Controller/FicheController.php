<?php

namespace Controller;

require_once("Lib/MoteurTemplate/RenderTamplate.php");
require_once('DBM/fiche.php');
require_once('Manager/DBManager.php');

Class FicheController extends \Lib\MoteurTemplate\RenderTamplate
{

    public function deleteAction($id)
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $fiche = new \DBM\Fiche();
            $fiche->setId((int) $id);
            $dbManager = new \Manager\DBManager();
            $dbManager->delete($fiche);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function editAction($id)
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $fiche = new \DBM\Fiche();
            $fiche->setId($id);
            $fiche->setLibelle($_POST["libelle"]);
            $fiche->setCategoryId($_POST["categoryId"]);
            $dbManager = new \Manager\DBManager();
            $dbManager->update($fiche);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function addAction()
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $fiche = new \DBM\Fiche();
            $fiche->setLibelle($_POST["libelle"]);
            $fiche->setCategoryId($_POST["categoryId"]);
            $dbManager = new \Manager\DBManager();
            $dbManager->insert($fiche);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

    public function listAction()
    {
        if (parent::isAjax() && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $dbManager = new \Manager\DBManager();
            $params = array();
            if (isset($_GET["ids"])) {
                $params[] = "c.id IN " . $_GET["ids"];
            } elseif (isset($_GET["searParams"])) {
                $params[] = "c.libelle LIKE '%" . $_GET["searParams"] . "%' OR f.libelle LIKE '%" . $_GET["searParams"] . "%' OR c.description LIKE '%" . $_GET["searParams"] . "%'";
            }
            $dbManager->queryFiche($params);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

}
