<?php

namespace Manager;

require_once('../Manager/DB.php');
require_once('../DBM/category.php');

/**
 * Description of CategoryManager
 *
 * @author josio
 */
class CategoryManager
{
    private $response;
    private $statement;

    public function __construct()
    {
        $db = new \Manager\DB();
        $this->statement = $db->getStatement();
        $this->response = array();
    }

    public function queryCategory($param = array())
    {
        $where = '';
        if (!empty($param)) {
            $where = " WHERE " . explode("AND", $param);
        }
        $sql = "SELECT * FROM category" . $where;
        $result = $this->statement->query($sql);
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

    public function queryFiche($param = array())
    {
        $where = '';
        if (!empty($param)) {
            $where = " WHERE " . explode("AND", $param);
        }
        $sql = "SELECT * FROM fiche" . $where;
        $result = $this->statement->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->response[] = array(
                    "id" => $row['id'],
                    "libelle" => $row['libelle'],
                    "categoryId" => $row['category_id']
                );
            }
        } else {
            $this->reponse = array(
                "info" => "Accune resulta trouvé"
            );
        }
    }

    public function insert($entity)
    {
        $sql = sprintf("INSERT INTO %s (parent_id, libelle, description) VALUES ( %s )", $entity->getName(), $entity->getValues());

        if ($this->statement->query($sql) === TRUE) {
            $this->reponse = array(
                "info" => "New record created successfully"
            );
        } else {
            $this->reponse = array(
                "error" => $this->statement->error
            );
        }
    }

    public function update($entity)
    {
        $sql = sprintf("UPDATE %s SET %s WHERE id=%d", $entity->getName(), $entity->setValues(), $entity->getValues());


        if ($this->statement->query($sql) === TRUE) {
            $this->reponse = array(
                "info" => "update record successfully"
            );
        } else {
            $this->reponse = array(
                "error" => $this->statement->error
            );
        }
    }

    public function delete($entity)
    {
        $sql = sprintf("DELETE FROM %s  WHERE id=%d", $entity->getName(), $entity->getValues());


        if ($this->statement->query($sql) === TRUE) {
            $this->reponse = array(
                "info" => "Detete record successfully"
            );
        } else {
            $this->reponse = array(
                "error" => $this->statement->error
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
