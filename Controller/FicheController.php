<?php

namespace Controller;

require_once("Lib/MoteurTemplate/RenderTamplate.php");
require_once('DBM/fiche.php');
require_once('Manager/DBManager.php');

Class FicheController extends \Lib\MoteurTemplate\RenderTamplate
{

    public function deleteAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function addAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fiche = new \DBM\Category();
            $fiche->setId($_POST["id"]);
            $fiche->setLibelle($_POST["libelle"]);
            $fiche->setCategoryId($_POST["categoryId"]);
            $dbManager = new \Manager\DBManager();
            $dbManager->insert($fiche);
            $this->renderJson($dbManager->getResponse());
        } else {
            $this->renderJson(array("error" => "Error Method sending"));
        }
    }

}
