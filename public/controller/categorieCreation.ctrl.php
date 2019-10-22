<?php

require_once ('../model/DAO.class.php');

function ajoutErreur(View $view, string $message) {
    $view->assign('erreur', $message);
}

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

function getCategories() : array {
    $db = new DAO();
    $catgeorie =  $db->select('Categorie');
    return $catgeorie;
}

function verfierValeur(View $view, array $info){
    $db = new DAO();

    if(!chaineValide($nomCat = $info['cat_name'])){
        ajoutErreur($view,"Le nom de catégorie ne peut pas être vide");
        return;
    }

    if (strlen($nomCat) > 50){
        ajoutErreur($view,"Le nom de catégorie ne doit pas depasser 50 caractères");
        return;
    }

    if(!chaineValide($parent = $info['parent'])){
        ajoutErreur($view,"Une catégorie doit avoir un parent");
        return;
    }

    if (empty($db->select('Categorie', 'nom=:parent', ['parent' => $parent]))) {
        ajoutErreur($view, "La catégorie parent $parent n'existe pas" );
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

require_once '../../framework/View.class.php';
$view = new View();

if (isset($_POST['ajouterCat'])){
    verfierValeur($view,$_POST);
}

if (isset($_GET['success'])) {
    $view->assign("succes", true);
}

$view->assign('cats',getCategories());
$view->setTitle('Creation de categorie');
$view->display('categorieCreation.view.php');





