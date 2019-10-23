<?php

require_once ('../model/DAO.class.php');
require_once ('_base.ctrl.php');

function getCategories() : array {
    $db = new DAO();
    $categorie =  $db->select('Categorie');
    return $categorie;
}

function verfierValeur(View $view, array $info){
    $db = new DAO();
    if(!chaineValide($nomCat = $info['cat_name'])){
        ajoutErreur($view,"Le nom de catégorie ne peut pas être vide");
        return;
    }

    if (strlen($nomCat) > 50){
        ajoutErreur($view,"Le nom de catégorie ne doit pas dépasser 50 caractères");
        return;
    }

    if(!chaineValide($parent = $info['parent'])){
        ajoutErreur($view,"Une catégorie doit avoir un parent");
        return;
    }

    if (empty($db->select('Categorie', 'nom=:parent', ['parent' => $parent]))) {
        ajoutErreur($view, "La catégorie parente $parent n'existe pas" );
        return;
    }

    if (!empty($db->select('Categorie', 'nom=:nom', ['nom' => $nomCat]))) {
        ajoutErreur($view, "La catégorie existe deja");
        return;
    }

    $db->run("INSERT INTO Categorie ('nom', 'parent') VALUES (:nom, :parent)", [
        'nom' => $nomCat,
        'parent' => $parent
    ]);
    header('Location: categorieCreation.ctrl.php?success=true');
    exit(0);
}

function supprimerCategorie(View $view, array $info) {
    $db = new DAO();

    if(!chaineValide($nomCat = $info['cat'] ?? '')){
        ajoutErreur($view,"Le nom de catégorie ne peut pas être vide");
        return;
    }
    if ($info['cat'] == "Produit"){
        ajoutErreur($view,"La catégorie Produit ne peut pas être supprimée");
        return;
    }
    if (empty($db->select('Categorie', 'nom=:nom', ['nom' => $nomCat]))) {
        ajoutErreur($view, "La catégorie parente $nomCat n'existe pas" );
        return;
    }
    $db->run("DELETE FROM Categorie WHERE nom=:nom", ['nom' => $nomCat]);
    header('Location: categorieCreation.ctrl.php?success=true');
    exit(0);
}



require_once '../../framework/View.class.php';
$view = new View();

if (isset($_POST['ajouterCat'])){
    verfierValeur($view,$_POST);
}

if(isset($_POST['supprimerCat'])){
    supprimerCategorie($view,$_POST);
}

if (isset($_GET['success'])) {
    $view->assign("succes", true);
}


$view->assign('cats',getCategories());
$view->setTitle('Création de catégorie');
$view->display('categorieCreation.view.php');





