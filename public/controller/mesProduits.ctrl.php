<?php
require_once ("../model/Produit.class.php");
require_once ("../model/Utilisateur.class.php");
require_once ("../model/DAO.class.php");

session_start();

$mesProduits = DAO::getDb()->selectAsClass('Produit','Produit',"`vendu-par` = :utilisateur",['utilisateur'=>Utilisateur::getUtilisateurConnecte()->getId()]);

require_once ("../../framework/View.class.php");

$_SESSION['prevurl']=explode('?', $_SERVER['REQUEST_URI'], 2)[0];

$view = new View();

if(isset($_GET['modif'])){
    $view->assign('succes','Modification validé');
}
if(isset($_GET['sup'])){
    $view->assign('succes','Suppression réussi');
}
if(isset($_GET['ajout'])){
    $view->assign('succes','Ajout réussi');
}

$view->assign('mesProduits',$mesProduits);
$view->setTitle('Mes Produit');
$view->display('mesProduits.view.php');
?>

