<?php

session_start();

require_once('_base.api.php');
require_once('../model/Message.class.php');
require_once('../model/Utilisateur.class.php');

if (!Utilisateur::isConnecte()) {
    erreur(403, "Vous n'êtes pas connecté.");
}

echo json_encode([
    'code' => 200,
    'message' => Message::getListeMessages()
]);
