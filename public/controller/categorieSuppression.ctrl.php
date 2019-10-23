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
    $catgeorie =  $db->select('categorie');
    return $catgeorie;
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
    header('Location: categorieSuppression.ctrl.php?success=true');
    exit(0);
}

require_once '../../framework/View.class.php';
$view = new View();

if(isset($_POST['supprimerCat'])){
    supprimerCategorie($view,$_POST);
}

if (isset($_GET['success'])) {
    $view->assign("succes", true);
}


$view->assign('cats',getCategories());
$view->setTitle('Suppression de catégorie');
$view->display('categorieSupression.view.php');
