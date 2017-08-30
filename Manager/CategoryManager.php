<?php

namespace Manager;

require_once('../Manager/DB.php');


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
    }

    public function getAllCategory()
    {
        $statemnet = $this->DB->getStatement();

        if ($statemnet == null) {
            return json_decode(array(
                "error" => "error connexion DB"
            ));
        }

        $sql = "SELECT * FROM category";
        $result = $statemnet->query($sql);
        if ($result->num_rows > 0) {
            //encour dev
        } else {
            return json_decode(array(
                "info" => "Accune resulta trouvé"
            ));
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
