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
    $categorie =  $db->select('categorie');
    return $categorie;
}


require_once '../../framework/View.class.php';
$view = new View();



if (isset($_GET['success'])) {
    $view->assign("succes", true);
}


$view->assign('cats',getCategories());
$view->setTitle('Suppression de catégorie');
$view->display('categorieSupression.view.php');


