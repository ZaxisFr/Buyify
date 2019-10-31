<?php

require_once ('../model/DAO.class.php');
require_once ('../model/Utilisateur.class.php');
require_once ('_base.ctrl.php');

session_start();
if (Utilisateur::isConnecte()) {
    header('Location: connexion.ctrl.php');
    exit(0);
}

function verifierInscription(View $view, array $info) {
    $db = DAO::getDb();

    if (!isset($info['nom'])) {
        ajoutErreur($view, 'Veuillez entrer votre nom complet.');
        return;
    }

    $nomComplet = explode(' ', $info['nom']);
    $nom = $nomComplet[0] ?? '';
    $prenom = $nomComplet[1] ?? '';

    if (!chaineValide($nom)) {
        ajoutErreur($view, 'Veuillez entrer votre nom.');
        return;
    }

    if (strlen($nom) > 30) {
        ajoutErreur($view, 'Votre nom ne doit faire que 30 caractères maximum.');
        return;
    }

    if (!chaineValide($prenom)) {
        ajoutErreur($view, 'Veuillez entrer votre prénom.');
        return;
    }

    if (strlen($prenom) > 30) {
        ajoutErreur($view, 'Votre prénom ne doit faire que 30 caractères maximum.');
        return;
    }

    if (!chaineValide($email = strtolower($info['mail'] ?? ''))) {
        ajoutErreur($view, 'Veuillez entrer votre adresse mail.');
        return;
    }

    if (strlen($email) > 50) {
        ajoutErreur($view, 'Votre adresse mail ne doit faire que 50 caractères maximum.');
        return;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        ajoutErreur($view, "L'adresse mail entrée est incorrecte.");
    }

    if (!empty($db->select('Utilisateur', 'email=:email', ['email' => $email]))) {
        ajoutErreur($view, 'Cette adresse mail est déjà utilisée.');
        return;
    }

    $mdp = $info['mdp'] ?? '';
    $confirm = $info['confirmation'] ?? '';

    if (strlen($mdp) < 6) {
        ajoutErreur($view, 'Le mot de passe doit faire au minimum 6 caractères.');
        return;
    }

    if ($mdp !== $confirm) {
        ajoutErreur($view, 'Le mot de passe et sa confirmation sont différents.');
        return;
    }

    $mdpHash = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 12]);

    $db->run("INSERT INTO Utilisateur ('nom', 'prenom', 'email', 'mot-de-passe') VALUES (:nom, :prenom, :email, :mdp)", [
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mdp' => $mdpHash
    ]);

    header('Location: inscription.ctrl.php?success=true');
    exit(0);
}

require_once '../../framework/View.class.php';
$view = new View();

if (isset($_POST['inscription'])) {
    verifierInscription($view, $_POST);
}
if (isset($_GET['success']) && filter_var($_GET['success'], FILTER_VALIDATE_BOOLEAN)) {
    $view->assign("succes", true);
}
$view->setTitle('Inscription');
$view->display('inscription.view.php');
