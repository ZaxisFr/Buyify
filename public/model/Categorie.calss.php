<?php
require_once "../model/DAO.class.php";

class Categorie
{
    private $_nom;
    private $_parent;

    /**
     * Categorie constructor.
     * @param string $nom
     * @param Categorie|null $parent
     * @throws Exception si la valeur de $nom est null
     */
    public function __construct(string $nom, Categorie $parent=null) {
        try{
            $this->setNom($nom);
            $this->setParent($parent);
        } catch (Exception $e){
            throw $e;
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
     * @throws Exception si $nom est null
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

    /**
     * Renvoi la liste des id d'un objet contenus dans la catégorie
     * @return array of object id
     */
    public function getProduits() : array {
        $dao = new DAO();
        $produits = $dao->select("Produit","categorie = :categorie",['categorie'=> $this->getNom()],"id");
        return $produits;
    }
}
?>
