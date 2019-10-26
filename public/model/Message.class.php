<?php

require_once('../model/Utilisateur.class.php');
require_once('../model/DAO.class.php');

class Message {
    private $id;
    private $contenu;
    private $date;
    private $lu;
    private $emetteur;
    private $recepteur;
    private $emetteurUtilisateur;
    private $recepteurUtilisateur;

    public function getId() : int {
        return $this->id;
    }

    public function getContenu() : string {
        return $this->contenu;
    }

    public function getDate() {
        return $this->date;
    }

    public function isLu() : bool {
        return $this->lu;
    }

    public function getEmetteurId() : int {
        return $this->emetteur;
    }

    public function getRecepteurId() : int {
        return $this->recepteur;
    }

    public function getEmetteur() : Utilisateur {
        if ($this->emetteurUtilisateur == null) {
            $this->emetteurUtilisateur = Utilisateur::getUtilisateurParId($this->emetteur);
        }

        return $this->emetteurUtilisateur;
    }

    public function getRecepteur() : Utilisateur {
        if ($this->recepteurUtilisateur == null) {
            $this->recepteurUtilisateur = Utilisateur::getUtilisateurParId($this->recepteur);
        }

        return $this->recepteurUtilisateur;
    }

    public static function getNbMessagesNonLus() : int {
        $db = new DAO();
        if (Utilisateur::isConnecte()) {
            $id = Utilisateur::getUtilisateurConnecte()->getId();
            return $db->select("message", 'lu=0 AND recepteur=:id', ['id' => $id], 'COUNT(DISTINCT id) AS nb')[0]['nb'];
        }

        return 0;
    }

}
