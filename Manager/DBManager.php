<?php

namespace Manager;

require_once('DB.php');
require_once('DBM/category.php');
require_once('DBM/Fiche.php');

/**
 * Description of CategoryManager
 *
 * @author josio
 */
class DBManager
{
    private $response;
    private $statement;

    public function __construct()
    {
        $db = new DB();
        $this->statement = $db->getStatement();
        $this->response = array();
    }

    public function queryCategory($param = array())
    {
        $where = '';
        if (!empty($param)) {
            $where = " WHERE " . implode(" AND ", $param);
        }
        $sql = "SELECT * FROM category" . $where;
        $result = $this->statement->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->response[] = array(
                    "id" => $row['id'],
                    "parent" => $row['parent_id'] ?: "#",
                    "text" => $row['libelle'],
                    "description" => $row['description']
                );
            }
        } else {
            $this->response = array(
                "info" => "Accune resulta trouvé"
            );
        }
    }

    public function queryFiche($param = array())
    {
        $where = '';
        if (!empty($param)) {
            $where = " WHERE " . implode(" AND ", $param);
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
            $this->response = array(
                "info" => "Accune resulta trouvé"
            );
        }
    }

    public function insert($entity)
    {
        $sql = sprintf("INSERT INTO %s (%s) VALUES ( %s )", $entity->getName(), $entity->getValuesToInsert(), $entity->getValues());

        if ($this->statement->query($sql) === TRUE) {
            $this->response = array(
                "info" => "New record created successfully"
            );
        } else {
            $response = array(
                "error" => $this->statement->error
            );
        }
    }

    public function update($entity)
    {
        $sql = sprintf("UPDATE %s SET %s WHERE id=%d", $entity->getName(), $entity->setValues(), $entity->getId());


        if ($this->statement->query($sql) === TRUE) {
            $this->response = array(
                "info" => "update record successfully"
            );
        } else {
            $this->response = array(
                "error" => $this->statement->error
            );
        }
    }

    public function delete($entity)
    {
        $sql = sprintf("DELETE FROM %s  WHERE id=%d", $entity->getName(), $entity->getId());


        if ($this->statement->query($sql) === TRUE) {
            $this->response = array(
                "info" => "Detete record successfully"
            );
        } else {
            $this->response = array(
                "error" => $this->statement->error
            );
        }
    }

    public function convetArrayToCategory($arrayList = array())
    {
        $arrayCategory = array();
        foreach ($arrayList as $value) {
            $category = new \DBM\Category;
            $category->setId($value["id"]);
            $category->setParentId($value["parentId"]);
            $category->setLibelle($value["libelle"]);
            $category->setDescription($value["description"]);
            $arrayCategory[] = $category;
        }
        return $arrayCategory;
    }

    public function convetArrayToFiches($arrayList = array())
    {
        $arrayFiche = array();
        foreach ($arrayList as $value) {
            $fiche = new \DBM\Fiche();
            $fiche->setId($value["id"]);
            $fiche->setLibelle($value["libelle"]);
            $fiche->setCategoryId($value["categoryId"]);
            $arrayFiche[] = $fiche;
        }
        return $arrayFiche;
    }

    public function getResponse()
    {
        return $this->response;
    }

}
