<?php

require_once('../model/Utilisateur.class.php');
require_once('../model/DAO.class.php');

class Message implements JsonSerializable {
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

    /**
     * Récupère le nombre de messages non lus de l'utilisateur courant
     * @return int Le nombre de messages non lus ou 0 si l'utilisateur est déconnecté
     */
    public static function getNbMessagesNonLus() : int {
        $db = new DAO();
        if (Utilisateur::isConnecte()) {
            $id = Utilisateur::getUtilisateurConnecte()->getId();
            return $db->select("message", 'lu=0 AND recepteur=:id', ['id' => $id], 'COUNT(DISTINCT id) AS nb')[0]['nb'];
        }

        return 0;
    }

    /**
     * Récupère la liste des conversations de l'utilisateur
     * @return array|null La liste des id des correspondants de l'utilisateur ou null s'il n'est pas connecté
     */
    public static function getListeConversations() : ?array {
        $db = new DAO();
        if (Utilisateur::isConnecte()) {
            $id = Utilisateur::getUtilisateurConnecte()->getId();
            $convList = $db->run("SELECT DISTINCT correspondant FROM (
                    SELECT emetteur AS correspondant FROM Message WHERE recepteur=:id
                    UNION
                    SELECT recepteur AS correspondant FROM Message WHERE emetteur=:id
                ) msg;", ['id' => $id]);
            $corresList = [];
            foreach ($convList as $conv) {
                $corresList[] = $conv['correspondant'];
            }
            return $corresList;
        }

        return null;
    }

    /**
     * Récupère une correspondance
     * @param int $correspondantId L'id de la personne avec qui l'utilisateur correspond
     * @return array|null La liste des messages
     */
    public static function getMessagesDe(int $correspondantId) : ?array {
        $db = new DAO();
        if (Utilisateur::isConnecte()) {
            $id = Utilisateur::getUtilisateurConnecte()->getId();
            return $db->selectAsClass("Message", "message", 'recepteur=:id AND emetteur=:id2 OR recepteur=:id2 AND emetteur=:id', [
                'id' => $id,
                'id2' => $correspondantId
            ]);
        }

        return null;
    }

    public static function getListeMessages() : ?array {
        if (Utilisateur::isConnecte()) {
            $conversations = self::getListeConversations();
            $messages = [];

            foreach ($conversations as $idCorrespondant) {
                $corres = Utilisateur::getUtilisateurParId($idCorrespondant);
                $nom = $corres->getNom() . ' ' . $corres->getPrenom();
                $messages[$idCorrespondant] = [
                    'correspondant' => $nom,
                    'messages' => self::getMessagesDe($idCorrespondant)
                ];
            }

            return $messages;
        }

        return null;
    }

    /**
     * Spécifie quelles données doivent être sérialisées dans un JSON
     */
    public function jsonSerialize() {
        $this->getRecepteur(); // On génère le récepteur et l'emetteur
        $this->getEmetteur();  // Pour éviter d'avoir des null dans la sérialisation
        $vars = get_object_vars($this);
        unset($vars['emetteur']);  // On unset l'emetteur et le récepteur car les id sont
        unset($vars['recepteur']); // déjà contenus dans les objets récupérés ci-dessus
        return $vars;
    }
}
