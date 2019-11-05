<?php

require_once('../model/DAO.class.php');
require_once '../model/Sanitizer.class.php';

class Produit
{
    private $id;
    private $intitule;
    private $description;
    private $prix;
    private $photo;
    private $categorie;


    public function getId() : int
    {
        return $this->id;
    }

    public function getIntitule() : string
    {
        return Sanitizer::sanitizeString($this->intitule);
    }

    public function getDescription() : string
    {
        return Sanitizer::sanitizeString($this->description);
    }

    public function getPrix() : string
    {
        return Sanitizer::sanitizeString($this->prix);
    }

    public function getPhoto() : string
    {
        return $this->photo;
    }

    public function getCategorie() : string
    {
        return Sanitizer::sanitizeString($this->categorie);
    }

    public function getVendeur() : int
    {
        $vendeur='vendu-par';
        return $this->$vendeur;
    }

    public function retirer(){
        self::retirerProduit($this->id);
    }

    static public function retirerProduit(int $id){
        DAO::getDb()->run("DELETE FROM Produit WHERE id=:id",["id"=>$id]);
    }
}
