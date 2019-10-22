<?php

require_once ('../model/DAO.class.php');

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

function ajoutErreur(View $view, string $message) {
    $view->assign('erreur', $message);
}

function getCategories() : array {
    $db = new DAO();
    $catgeorie =  $db->select('Categorie');
    return $catgeorie;
}

function suprimierCategorie(View $view, array $info) {
    $db = new DAO();

    if(!chaineValide($nomCat = $info['cat'])){
        ajoutErreur($view,"Le nom de catégorie ne peut pas être vide");
        return;
    }
    if ($info['cat'] == "Produit"){
        ajoutErreur($view,"La catégorie Produit ne peut pas être supprimée");
        return;
    }

    if (empty($db->select('Categorie', 'nom=:nom', ['nom' => $nomCat]))) {
        ajoutErreur($view, "La catégorie parent $nomCat n'existe pas" );
        return;
    }

    $db->run("DELETE FROM Categorie WHERE nom=:nom", ['nom' => $nomCat]);
    header('Location: categorieSupression.ctrl.php?success=true');
    exit(0);
}

require_once '../../framework/View.class.php';
$view = new View();

if(isset($_POST['suprimerCat'])){
    suprimierCategorie($view,$_POST);
}

if (isset($_GET['success'])) {
    $view->assign("succes", true);
}


$view->assign('cats',getCategories());
$view->setTitle('Supression de categorie');
$view->display('categorieSupression.view.php');





