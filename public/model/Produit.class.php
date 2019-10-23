<?php

class Produit
{
    private $id;
    private $intitule;
    private $description;
    private $prix;
    private $photo;
    private $categorie;
    private $vendeur;

    /**
     * Produit constructor.
     * @param $id
     * @param $intitule
     * @param $description
     * @param $prix
     * @param $photo
     * @param $categorie
     * @param $vendeur
     */
    public function __construct(string $id, string $intitule, string $description, float $prix, string $photo, string $categorie, int $vendeur)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->description = $description;
        $this->prix = $prix;
        $this->photo = $photo;
        $this->categorie = $categorie;
        $this->vendeur = $vendeur;
    }

    /**
     * @return mixed
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIntitule() : string
    {
        return $this->intitule;
    }

    /**
     * @return mixed
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrix() : string
    {
        return $this->prix;
    }

    /**
     * @return mixed
     */
    public function getPhoto() : string
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getCategorie() : string
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function getVendeur() : int
    {
        return $this->vendeur;
    }


}

?>