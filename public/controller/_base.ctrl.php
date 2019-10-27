<?php

function ajoutErreur(View $view, string $message) {
    $view->assign('erreur', $message);
}

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

