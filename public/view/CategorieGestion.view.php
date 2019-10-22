<?php
        echo "lol";
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <title>Gestion des catégorie</title>
    <section>
        <h2>Ajouter une catégorire</h2>
        <form action="" method="get" class="form-Ajout">
            <label for="cat_name">Nom de la catégorie </label>
            <input type="text" name="cat_name" id="cat_name" required> </br>
            <label for="cat_name">Catégorie parents</label>
            <input list="cat_list" id="cat_choice" name="cat_choice" required/></br>
            <input type="submit" value="Ajouter">
        </form>


        <datalist id="cat_list">
            <option value="Chocolate">
            <option value="Coconut">
            <option value="Mint">
            <option value="Strawberry">
            <option value="Vanilla">
        </datalist>

    </section>
    <section>
        <h2>Supprimer une catégoie</h2> 
        <form action="" method="get" class="form-Ajout">
            <label for="cat_name">Catégorie parents</label>
            <input list="cat_list" id="cat_choice" name="cat_choice" required/></br>
            <input type="checkbox" id="scales" name="scales" required> <label for="scales">Je cofirme la supression ! PS : cette action est ireversible</label></br>
            <input type="submit" value="Suprimer">
        </form>
    </section>
</head>
<body>
</body>
</html>
