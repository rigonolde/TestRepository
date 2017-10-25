<?php

namespace Manager;

require_once($_SERVER["DOCUMENT_ROOT"] . '/Config/Config.php');

use Config\Config;

/**
 * Description of DBConnexion
 *
 * @author josio
 */
class DB extends Config
{
    private $statement;

    public function __construct()
    {
        $this->statement = null;
        $this->bdConnexion();
    }

    public function bdConnexion()
    {
        $conn = new \mysqli(parent::BD_HOST, parent::BD_USER, parent::BD_PASSWD, parent::BD_NAME, parent::BD_PORT);
        if ($conn->connect_error) {
            die('Erreur Connection de la base de données ou éteint');
        }
        $this->setStatement($conn);
    }

    function getConfig()
    {
        return $this->config;
    }

    function getStatement()
    {
        return $this->statement;
    }

    function setConfig($config)
    {
        $this->config = $config;
    }

    function setStatement($statement)
    {
        $this->statement = $statement;
    }

}
