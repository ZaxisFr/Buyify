<?php
session_start();
require_once('_base.ctrl.php');
require_once('../model/DAO.class.php');
require_once ("../model/Produit.class.php");
require_once '../../framework/View.class.php';

function getProduit(int $id): ?Produit {
    $db = DAO::getDb();

    $produit = $db->selectAsClass('Produit','Produit','id=:id',['id' => $id]);
    return $produit[0] ?? null;
}

function produitInexistant() {
    header('Location: errorPage.ctrl.php?error=400&msg=Id de produit recherché manquant ou incorrect');
    exit(0);
}

$view = new View();
if(isset($_GET['id'])) {
    $produit = getProduit($_GET['id']);
    if ($produit != null) {
        $view->assign('produit', $produit);
    } else {
        produitInexistant();
    }
} else {
    produitInexistant();
}

$view->setTitle('Buyify');
$view->display('produit.view.php');
