<?php
session_start();
if(isset($_GET['id'])&&isset($_SESSION['prevurl'])){
    require_once("../model/Produit.class.php");
    Produit::retirerProduit($_GET['id']);
    header('location: '.$_SESSION['prevurl'].'?sup=true');
}
else{
    header('location: '.$_SERVER['HTTP_HOST']);
}
?>
