<?php

require_once('../model/Utilisateur.class.php');
require_once '_base.api.php';

session_start();
if (!Utilisateur::isConnecte()) {
    erreur(403, "Vous n'êtes pas connecté.");
}

$id = $_POST['id'];
$contenu = trim($_POST['message'] ?? '');

$db = new DAO();

$correspondant = Utilisateur::getUtilisateurParId($id);
if (empty($correspondant)) {
    erreur(400, 'Id correspondant incorrect.');
} else if (empty($contenu)) {
    erreur(400, 'Message vide');
}

$db->run("INSERT INTO Message (contenu, emetteur, recepteur) VALUES (:contenu, :id, :id2)", [
    'id' => $_SESSION['id'],
    'id2' => $correspondant->getId(),
    'contenu' => $contenu
]);

succes();
