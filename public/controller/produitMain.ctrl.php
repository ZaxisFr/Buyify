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
        $filtres['categorie'] = "Produits";
    }

    if (isset($info['prixMin'])){
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
    $view->assign('produits',trouverProduit($filtres));
    $view->assign('info',$info);
    $view->assign("filtres", $filtres);

}
function trouverProduit(array $filtres) : array{
    $db = new DAO();
    $where = ' ? ';
    $bind[] = $filtres['categorie'];
    foreach (getCategoriesFille(getCategorie($filtres['categorie'])) as $cat ){
        $where = $where . ', ? ';
        $bind[] = $cat['nom'];
    }
    $bind[] = $filtres['prixMin'];
    $bind[] = $filtres['prixMax'];
    $produits = $db->select('Produit', "categorie IN (".$where .") AND PRIX >= ? AND PRIX <= ?", $bind);
    // $produits = $db->select('Produit',':whereCat prix >=:prixMin AND prix<=:prixMax', ['whereCat' => $whereCat, 'prixMin' => $filtres['prixMin'],'prixMax' => $filtres['prixMax']]);


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
$view->setTitle('BuyIfy');
$view->display('produitListe.view.php');

