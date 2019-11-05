<?php

require_once ('../model/DAO.class.php');
require_once ('../model/Utilisateur.class.php');
require_once '../../framework/View.class.php';
require_once ('_base.ctrl.php');

session_start();

if (Utilisateur::isConnecte()) {
    header('Location: /');
    exit(0);
}

$view = new View();

function verifierConnexion(View $view, array $infos) {
    $email = strtolower($infos['mail'] ?? '');
    $mdp = $infos['mdp'] ?? '';

    $db = DAO::getDb();
    $utilisateur = $db->selectAsClass('Utilisateur', 'Utilisateur', 'email=:email', ['email' => $email]);
    if (!isset($utilisateur[0])) {
        ajoutErreur($view, "L'adresse email renseignée ne correspond à aucun compte.");
        return;
    }

    $utilisateur = $utilisateur[0];
    if (!password_verify($mdp, $utilisateur->getMdp())) {
        ajoutErreur($view, "Le mot de passe ne correspond pas.");
        return;
    }

    $_SESSION['id'] = $utilisateur->getId();
    $_SESSION['nom'] = $utilisateur->getNom();
    $_SESSION['prenom'] = $utilisateur->getPrenom();
    $_SESSION['email'] = $utilisateur->getEmail();

    header('Location: /');
    exit(0);
}

if (isset($_POST['connexion'])) {
    verifierConnexion($view, $_POST);
}
$view->setTitle('Connexion');
$view->display('connexion.view.php');
