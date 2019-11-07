<?php
require_once ("../model/Produit.class.php");
require_once ("../model/Utilisateur.class.php");
require_once ("../model/DAO.class.php");

session_start();

if(!Utilisateur::isConnecte()){
    header('Location: connexion.ctrl.php');
    exit(0);
}

$mesProduits = DAO::getDb()->selectAsClass('Produit','Produit',"`vendu-par` = :utilisateur",['utilisateur'=>Utilisateur::getUtilisateurConnecte()->getId()]);

require_once ("../../framework/View.class.php");

$_SESSION['prevurl']=explode('?', $_SERVER['REQUEST_URI'], 2)[0];

$view = new View();

if(isset($_GET['modif'])){
    $view->assign('succes','Modification validée');
}
if(isset($_GET['sup'])){
    $view->assign('succes','Suppression réussie');
}
if(isset($_GET['ajout'])){
    $view->assign('succes','Ajout réussi');
}

$view->assign('mesProduits',$mesProduits);
$view->setTitle('Mes Produit');
$view->display('mesProduits.view.php');
?>

