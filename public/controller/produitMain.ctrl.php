<?php
require_once ('../model/DAO.class.php');
require_once ('_base.ctrl.php');

function definitEvironement(View $view, array $info) {
    if (isset($info['numPage'])) {
        $numPage = $info['numPage'];
    } else {
        $numPage = 1;
    }
    $view->assign("numPage", $numPage);

    if (isset($info['nbElemPage'])) {
        $nbElemPage = $info['nbElemPage'];
    } else {
        $nbElemPage = 10;
    }

    $view->assign("nbElemPage", $nbElemPage);

    if (isset($info['filtres'])){
        $filtres = $info['filtres'];
    } else {
        $filtres = array();
    }

    if (isset($info['categorie'])){
        $filtres['categorie'] = $info['categorie'];
    } else {
        $filtres['categorie'] = "Produit";
    }

    if (isset($info['prixMin'])){
        if($info['prixMin'] <= 0 ){
        }
        $filtres['prixMin'] = $info['prixMin'];
    } else {
        $filtres['prixMin'] = 0;
    }

    if($filtres['prixMin'] < 0){
        ajoutErreur($view,"Le prix ne peut pas être pas négatif");
        $filtres['prixMin'] = 0;
    }

    if (isset($info['prixMax'])){
        $filtres['prixMax'] = $info['prixMax'];

    } else {
        $filtres['prixMax'] = 999999;
    }

    if($filtres['prixMax'] < 0){
        ajoutErreur($view,"Le prix ne peut pas être pas négatif");
        $filtres['prixMax'] = 0;

    }

    $view->assign('info',$info);
    $view->assign("filtres", $filtres);

}
function trouverProduit(array $filtres) : array{
    $db = new DAO();
    $produits = $db->select('Produit');


    return $produits;
}

function getCategories() : array {
    $db = new DAO();
    $categorie =  $db->select('Categorie');
    return $categorie;
}



require_once('_base.ctrl.php');

require_once '../../framework/View.class.php';
$view = new View();
$view->assign('cats',getCategories());


definitEvironement($view,$_POST);
$view->assign('test',getCategorie("Produits"));
$view->assign('Prod',trouverProduit(array()));
$view->setTitle('BuyIfy');
$view->display('produitListe.view.php');

