<?php

/**
 * Table Fiche
 *
 * @author josio
 */
class Fiche
{
    /*
     * Integer $id
     */
    private $id;

    /*
     * @var String $libelle
     */
    private $libelle;

    /*
     * @var Integer $parent_id
     */
    private $category_id;

    function getId()
    {
        return $this->id;
    }

    function getLibelle()
    {
        return $this->libelle;
    }

    function getCategory_id()
    {
        return $this->category_id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    function setCategory_id($category_id)
    {
        $this->category_id = $category_id;
    }

}
