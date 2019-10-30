<?php
class Layer {
    // Paramètres de la vue, dans un tableau associatif
    private $param;

    // Constructeur d'une vue
    function __construct() {
        // Initialise un tableau vide de paramètres
        $this->param = array();
    }

    // Ajoute une variable à la layer
    function assign(string $varName,$value) {
        $this->param[$varName] = $value;
    }

    // Affiche du layer
    function display(string $filename) {

        // Tous les attributs de l'objet sont dupliqués en des variables
        // locales à la fonction display. Cela simplifie l'expression des
        // valeurs de la vue. Il faut simplement utiliser <?= $variable

        // Parcourt toutes les variables de la vue
        foreach ($this->param as $key => $value) {
            // La notation $$ dédigne une variable de le nom est dans une autre variable
            $$key = $value;
        }

        require("../view/layer/$filename");
    }

    static function displayStatique(string $filename, array $param) {

        // Tous les attributs de l'objet sont dupliqués en des variables
        // locales à la fonction display. Cela simplifie l'expression des
        // valeurs de la vue. Il faut simplement utiliser <?= $variable

        // Parcourt toutes les variables de la vue
        foreach ($param as $key => $value) {
            // La notation $$ dédigne une variable de le nom est dans une autre variable
            $$key = $value;
        }

        require("../view/layer/$filename");
    }

    // Affiche toutes les valeurs des paramètres de la vue
    function dump() {
        foreach ($this->param as $key => $value) {
            print("<br/><b>$key: </b>\n");
            var_dump($value);
        }
    }
}
?>