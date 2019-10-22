
<div id="categorieCreation-body" >
        <h2>Ajouter une catégorire</h2>
    <?php if (isset($erreur)): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>
    <?php if (isset($succes)): ?>
        <p class="bg-success banner">La catégorie a été ajoutée <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif;?>
        <form action="<?= $_SERVER['PHP_SELF']?>" method="post" >
            <label for="cat_name">Nom de la catégorie </label>
            <input type="text" name="cat_name" id="cat_name" required> </br>
            <label for="cat_name">Catégorie parents</label>
            <select id="parent" name="parent" required>
                 <?php foreach ($cats as $cat){
                    echo "<option value=\"" . $cat['nom'] . "\">" . $cat['nom'] . "</option>";
                }
                ?>
            </select></br>
            <input type="submit" value="Envoyer" name="ajouterCat" />
        </form>
</div>