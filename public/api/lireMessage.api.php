<?php

require_once('../model/Utilisateur.class.php');
require_once '_base.api.php';

session_start();
if (!Utilisateur::isConnecte()) {
    erreur(403, "Vous n'êtes pas connecté.");
}

$nom = explode(' ', $_POST['nom'] ?? ' ');
$date = $_POST['date'] ?? '';

$db = new DAO();

$correspondant = $db->selectAsClass('Utilisateur', 'Utilisateur', 'nom=:nom AND prenom=:prenom', [
    'nom' => $nom[0],
    'prenom' => $nom[1]
]);
if (empty($correspondant)) {
    erreur(400, 'Id correspondant incorrect.');
} else if (empty($date)) {
    erreur(400, 'Date de lecture manquante.');
}

$db->run("UPDATE Message SET lu=1 WHERE recepteur=:id AND emetteur=:id2 AND date <= :date", [
    'id' => $_SESSION['id'],
    'id2' => $correspondant[0]->getId(),
    'date' => $date
]);

succes();
