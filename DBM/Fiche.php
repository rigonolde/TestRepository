<?php

namespace DBM;

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
    private $categoryId;

    function getId()
    {
        return $this->id;
    }

    function getLibelle()
    {
        return $this->libelle;
    }

    function getCategoryId()
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

    function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getValues()
    {
        return $this->getLibelle() . "," . $this->getCategoryId();
    }

    public function setValues()
    {
        return "libelle=" . $this->getLibelle() . "," . "category_id=" . $this->getCategoryId();
    }

    public function getName()
    {
        return "fiche";
    }

    public function getValuesToInsert()
    {
        return "libelle, description, category_id";
    }

}
