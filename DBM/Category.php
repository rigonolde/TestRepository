<?php

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
    private $parent_id;

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

    function getParent_id()
    {
        return $this->parent_id;
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

    function setParent_id($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

}
