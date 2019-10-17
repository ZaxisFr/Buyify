<?php

require_once ('../model/DAO.class.php');
require_once ('../model/Utilisateur.class.php');
require_once '../../framework/View.class.php';

session_start();

$view = new View();

function ajoutErreur(View $view, string $message) {
    $view->assign('erreur', $message);
}

function verifierConnexion(View $view, array $infos) {
    $email = $infos['email'] ?? '';
    $mdp = $infos['mdp'] ?? '';

    $db = new DAO();
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

    header('Location: connexion.ctrl.php');
    exit(0);
}

if (isset($_POST['connexion'])) {
    verifierConnexion($view, $_POST);
}
$view->setTitle('Connexion');
$view->display('connexion.view.php');
