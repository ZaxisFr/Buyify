<?php

require_once('../model/DAO.class.php');

class Utilisateur {

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;

    public function __construct(int $id, string $nom, string $prenom, string $email, string $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

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
        return $this->mdp;
    }



}
