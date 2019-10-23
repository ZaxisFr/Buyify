<?php
require_once "../model/DAO.class.php";

class Categorie
{
    private $_nom;
    private $_parent;

    /**
     * Categorie constructeur.
     * @param string $nom
     * @param Categorie|null $parent
     * @throws Exception si la valeur de $nom est null
     */
    public function __construct(string $nom, Categorie $parent=null) {
        if(is_null($nom)){
            throw new Exception('Nom de catégorie vide');
        } else {
            $this->_nom = $nom;
        }
        $this->_parent = $parent;
    }

    /**
     * @return string
     */
    public function getNom(): string {
        return $this->_nom;
    }
        /**
     * @return Categorie
     */
    public function getParent(): Categorie {
        return $this->_parent;
    }

    /**
     * Renvoi la liste des id d'un objet contenus dans la catégorie
     * @return array of object id
     */
    public function getProduits() : array {
        $dao = new DAO();
        $produits = $dao->selectAsClass("Categorie","Produit","categorie = :categorie",['categorie'=> $this->getNom()],"id");
        return $produits;
    }
}
?>
