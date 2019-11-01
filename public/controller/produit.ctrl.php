<?php
session_start();
require_once('_base.ctrl.php');
require_once('../model/DAO.class.php');
require_once ("../model/Produit.class.php");
require_once '../../framework/View.class.php';

function getPorduit(int $id): Produit {
    $db = DAO::getDb();

    $produit = $db->selectAsClass('Produit','Produit','id=:id',['id' => $id]);
    return $produit[0];
}

$view = new View();
if(isset($_GET['id'])){
    $view->assign('produit',getPorduit($_GET['id']));
} else {
    header('Location: errorPage.ctrl.php?error=500&msg="Ooups c\'est tout cassé mais ça n\'est pas de votre Faute"');
    exit(0);
}

$view->setTitle('BuyIfy');
$view->display('produit.view.php');
