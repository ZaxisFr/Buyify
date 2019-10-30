<?php
session_start();
if(isset($_GET['id'])&&isset($_SESSION['prevurl'])){
    require_once('../model/DAO.class.php');
    require_once('../model/Utilisateur.class.php');
    $db = new DAO();
    $utiliseurCourant = Utilisateur::getUtilisateurConnecte();
    if($utiliseurCourant->isFavori($_GET['id'])){
        $db->run('DELETE FROM Favori WHERE `id-utilisateur` = :utilisateur and `id-produit` = :produit',['utilisateur' => $utiliseurCourant->getId(), 'produit'=>$_GET['id']]);
    }else{
        $db->run('INSERT INTO Favori(`id-utilisateur`,`id-produit`) VALUES (:utilisateur,:produit)',['utilisateur' => $utiliseurCourant->getId(), 'produit'=>$_GET['id']]);
    }
    header('location: '.$_SESSION['prevurl']);
}
else{
    header('location: '.$_SERVER['HTTP_HOST']);
}
?>
