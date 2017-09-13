<?php

namespace DBM;

/**
 * Table Category
 *
 * @author josio
 */
class Category
{
    /*
     * Integer $id
     */
    private $id;

    /*
     * @var Integer $parent_id
     */
    private $parentId;

    /*
     * @var String $libelle
     */
    private $libelle;

    /*
     * @var String $description
     */
    private $description;

    function getId()
    {
        return $this->id;
    }

    function getParentId()
    {
        return $this->parentId;
    }

    function getLibelle()
    {
        return $this->libelle;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    public function getValues()
    {
        return $this->getParentId() . ",'" . $this->getLibelle() . "','" . $this->getDescription() . "'";
    }

    public function setValues()
    {
        return "parent_id=" . $this->getParentId() . "," . "libelle='" . $this->getLibelle() . "'," . "description='" . $this->getDescription() . "'";
    }

    public function getName()
    {
        return "category";
    }

    public function getValuesToInsert()
    {
        return "parent_id, libelle, description";
    }

}
