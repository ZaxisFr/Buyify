<?php

require_once('../model/DAO.class.php');

class Utilisateur implements JsonSerializable {

    private $id;
    private $nom;
    private $prenom;
    private $email;

    public static function getUtilisateurParId($id) : Utilisateur {
        $db = new DAO();
        return $db->selectAsClass('Utilisateur', 'Utilisateur', 'id=:id', ['id' => $id])[0];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getMdp(): string {
        $mdp = 'mot-de-passe';
        return $this->$mdp; // Le nom de la colonne est mot-de-passe, qui ne peut pas être donné à une variable en PHP
    }

    /**
     * Vérifie si l'utilisateur est connecté : nécessite l'ouverture de session
     * @return bool
     */
    public static function isConnecte() : bool {
        return isset($_SESSION['id']);
    }

    public static function getUtilisateurConnecte() : ?Utilisateur {
        return (self::isConnecte()) ? self::getUtilisateurParId($_SESSION['id']) : null;
    }

    /**
     * Spécifie quelles données doivent être sérialisées dans un JSON
     */
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        unset($vars['mot-de-passe']);
        return $vars;
    }
}
