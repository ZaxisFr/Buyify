<?php

require_once ('../model/DAO.class.php');

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

function ajoutErreur(View $view, string $message) {
    $view->assign('erreur', $message);
}

function verifierInscription(View $view, array $info) {
    $db = new DAO();

    var_dump($info);

    if (!chaineValide($nom = $info['nom'])) {
        ajoutErreur($view, 'Veuillez entrer votre nom.');
        return;
    }

    if (strlen($nom) > 30) {
        ajoutErreur($view, 'Votre nom ne doit faire que 30 caractères maximum.');
        return;
    }

    if (!chaineValide($prenom = $info['prenom'])) {
        ajoutErreur($view, 'Veuillez entrer votre prénom.');
        return;
    }

    if (strlen($prenom) > 30) {
        ajoutErreur($view, 'Votre prénom ne doit faire que 30 caractères maximum.');
        return;
    }

    if (!chaineValide($email = $info['mail'])) {
        ajoutErreur($view, 'Veuillez entrer votre adresse mail.');
        return;
    }

    if (strlen($email) > 50) {
        ajoutErreur($view, 'Votre adresse mail ne doit faire que 50 caractères maximum.');
        return;
    }

    if (!empty($db->select('Utilisateur', 'email=:email', ['email' => $email]))) {
        ajoutErreur($view, 'Cette adresse mail est déjà utilisée.');
        return;
    }

    $mdp = $info['mdp'];
    $confirm = $info['confirmation'];

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
if (isset($_GET['success']) && $_GET['success'] === "true") {
    $view->assign("succes", true);
}
$view->setTitle('Inscription');
$view->display('inscription.view.php');
