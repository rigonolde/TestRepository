<?php

namespace Manager;

require_once('../Manager/DB.php');
require_once('../DBM/category.php');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryManager
 *
 * @author josio
 */
class CategoryManager
{
    private $response;
    private $DB;

    public function __construct()
    {
        $this->DB = new \Manager\DB();
        $response = array();
    }

    public function getAllCategory()
    {
        $statemnet = $this->DB->getStatement();

        if ($statemnet == null) {
            $this->reponse = json_decode(array(
                "error" => "error connexion DB"
            ));
        }

        $sql = "SELECT * FROM category";
        $result = $statemnet->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->response[] = array(
                    "id" => $row['id'],
                    "parentId" => $row['parent_id'],
                    "libelle" => $row['libelle'],
                    "description" => $row['description']
                );
            }
        } else {
            $this->reponse = array(
                "info" => "Accune resulta trouvé"
            );
        }
    }

    function getResponse()
    {
        return $this->response;
    }

    function setResponse($response)
    {
        $this->response = $response;
    }

}
