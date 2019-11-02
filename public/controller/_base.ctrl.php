<?php

function ajoutErreur(View $view, string $message) {
    $view->assign('erreur', $message);
}

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

/**
 * @param array $categoriesParents
 * @return array
 * Fonction recursive
 * Retourne toutes les catégories filles des catégorie contenues dans $categoriesParents
 */
function getCategoriesFille(array $categoriesParents) : array {
    $db =DAO::getDb();
    $categorie = array();
    foreach ($categoriesParents as $cat) {
        $categorie = array_merge($categorie, $db->select('Categorie', 'parent=:nom', ['nom' => $cat['nom']]));
        $sousCategorie = getCategoriesFille($categorie);
        $categorie = array_merge($categorie, $sousCategorie);
    }
    if (isset($sousCategorie)) {
        return $categorie + $sousCategorie;
    }
    return $categorie;
}

/**
 * @param string $nom
 * @return array
 * Retourn un array contenant la catégorie.
 */
function getCategorie(string $nom) : array {
    $db = DAO::getDb();
    $categorie = $db->select('Categorie','nom=:nom', ['nom' => $nom]);
    return $categorie;
}
