<?php

session_start();
require_once ("../model/Utilisateur.class.php");

if(Utilisateur::isConnecte()){
    require_once ("../model/DAO.class.php");
    require_once ("../model/Produit.class.php");

    $db = DAO::getDb();

    $utilisateurCourant = Utilisateur::getUtilisateurConnecte();

    $produitsFavoris = $db->selectAsClass('Produit','Produit','id in (SELECT `id-produit` FROM Favori WHERE `id-utilisateur` = :id)',[
        'id'=>$utilisateurCourant->getId()
    ],'*');

    require_once ("../../framework/View.class.php");

    $_SESSION['prevurl'] = $_SERVER['REQUEST_URI'];

    $view = new View();

    $view->assign('produitsFavoris', $produitsFavoris);

    $view->setTitle('Favoris');

    $view->display("../view/favori.view.php");
}
else{
    header('location: connexion.ctrl.php');
}
?>

