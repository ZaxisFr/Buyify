<?php
require_once "../model/DAO.class.php";
require_once "../model/Sanitizer.class.php";

class Categorie
{
    private $nom;
    private $parent;

    public function getNom(): string {
        return Sanitizer::sanitizeString($this->nom);
    }

    public function getParent(): string {
        return $this->parent;
    }
}
