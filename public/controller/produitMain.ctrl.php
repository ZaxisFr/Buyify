<?php
session_start();
require_once('../model/DAO.class.php');
require_once('_base.ctrl.php');
require_once ("../model/Produit.class.php");
require_once '../../framework/View.class.php';

function definirEnvironnement(View $view, array $info) {

    if (isset($info['filtres'])) {
        $filtres = $info['filtres'];
    } else {
        $filtres = array();
    }

    if (isset($info['categorie'])) {
        $filtres['categorie'] = $info['categorie'];
    } else {
        $filtres['categorie'] = "Produits";
    }

    if (isset($info['prixMin'])) {
        $filtres['prixMin'] = $info['prixMin'];
    } else {
        $filtres['prixMin'] = 0;
    }

    if ($filtres['prixMin'] < 0) {
        ajoutErreur($view, "Le prix ne peut pas être négatif");
        $filtres['prixMin'] = 0;
    }

    if (isset($info['prixMax'])) {
        $filtres['prixMax'] = $info['prixMax'];
    } else {
        $filtres['prixMax'] = 999999;
    }

    if ($filtres['prixMax'] < 0) {
        ajoutErreur($view, "Le prix ne peut pas être négatif");
        $filtres['prixMax'] = 0;
    }

    if (isset($_GET['page'])) {
        $numPage = $_GET['page'];
    } else {
        $numPage = 1;
    }

    if (isset($_GET['nbProd'])) {
        $nbProd = $_GET['nbProd'];
    } else {
        $nbProd = 8;
    }

    $produits = trouverProduit($filtres);
    $nombreProduit = sizeof($produits);
    $nombrePages = ($nombreProduit / $nbProd);
    if (fmod($nombrePages, 1) !== 0.0){ //si $numpage == 1,3 on veut quand même une page de plus.
        $nombrePages = ceil($nombrePages);
    }

    if($nombreProduit == 0){
        header('Location: errorPage.ctrl.php?error=404&msg="Il semble qu\'il n\'y ait pas de produit correspondant "');
        exit(0);
    }

    $view->assign('cats', getCategories());
    $view->assign("filtres", $filtres);
    $view->assign('nbProd', $nbProd);
    $view->assign('nombrePages',$nombrePages);
    $view->assign('nombreProduits',$nombreProduit);
    $view->assign("numPage", $numPage);
    $view->assign('produits', $produits);
}

function trouverProduit(array $filtres): array {
    $db =DAO::getDb();
    $where = ' ? ';
    $bind[] = $filtres['categorie'];
    foreach (getCategoriesFille(getCategorie($filtres['categorie'])) as $cat) {
        $where = $where . ', ? ';
        $bind[] = $cat['nom'];
    }
    $bind[] = $filtres['prixMin'];
    $bind[] = $filtres['prixMax'];
    $produits = $db->selectAsClass('Produit', 'Produit',"categorie IN (" . $where . ") AND PRIX >= ? AND PRIX <= ?", $bind);

    return $produits;
}

function getCategories(): array {
    $db = DAO::getDb();
    $categorie = $db->select('Categorie');
    return $categorie;
}

$view = new View();
definirEnvironnement($view, $_POST);
$view->setTitle('Buyify');
$view->display('produitListe.view.php');
