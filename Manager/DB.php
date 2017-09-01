<?php

namespace Manager;

require_once('Config/Config.php');

use Config\Config;

/**
 * Description of DBConnexion
 *
 * @author josio
 */
class DB
{
    private $config;
    private $statement;

    public function __construct()
    {
        $this->config = new \Config\Config();
        $this->statement = null;
        $this->bdConnexion();
    }

    public function bdConnexion()
    {
        $conn = new \mysqli($this->config->BD_HOST, $this->config->BD_USER, $this->config->BD_PASSWD, $this->config->BD_NAME, $this->config->BD_PORT);

        if ($conn->connect_error) {
            return false;
        }
        $this->setStatement($conn);
        return true;
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
