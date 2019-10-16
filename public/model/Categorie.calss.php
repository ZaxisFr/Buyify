<?php
require_once "../modem/DAO.class.php";

class Categorie
{
    private string $_nom;
    private Categorie $_parent;

    /**
     * Categorie constructor.
     * @param string $_nom
     * @param Categorie $_parent
     */
    public function __construct(string $nom, Categorie $parent=null) {
        try{
            $this->setNom($nom);
            $this->setParent($parent);
        } catch (Exception $e){

        }

    }

    /**
     * @return string
     */
    public function getNom(): string {
        return $this->_nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void {
        if(is_null($nom)){
            throw new Exception('Nom de catégoire vide');
        } else {
            $this->_nom = $nom;
        }
        
    }

    /**
     * @return Categorie
     */
    public function getParent(): Categorie {
        return $this->_parent;
    }

    /**
     * @param Categorie $parent
     */
    public function setParent(Categorie $parent): void {
        $this->_parent = $parent;
    }

    public function getProduits() : array {
        $dao = new DAO();
        $produits = $dao->select("Produit","categorie = :categorie",['categorie'=> $this->getNom()],"id");
        return $produits;
    }




}