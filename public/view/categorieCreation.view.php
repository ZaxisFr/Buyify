<?php if (isset($erreur)): ?>
    <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
<?php endif; ?>
<?php if (isset($succes)): ?>
    <p class="bg-success banner">Operation effectuée <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
<?php endif;?>

<div id="categorie-body" class="container_fluid">
    <div class="card w-25">
        <div class="card-header">
            <h5>Ajouter une catégorie</h5>
        </div>
        <div class="card-body mx-3">
            <form action="<?= $_SERVER['PHP_SELF']?>" method="post" >
                <div class="form-group">
                    <label for="cat_name">Nom de la catégorie </label>
                    <input  class="form-control" type="text" name="cat_name" id="cat_name" required> </br>
                </div>
                <div class="form-group">
                    <label for="cat_name">Catégorie parente</label>
                    <select  class="form-control" id="parent" name="parent" required>
                        <?php foreach ($cats as $cat){
                            echo "<option value=\"" . $cat['nom'] . "\">" . $cat['nom'] . "</option>";
                        }
                        ?>
                    </select></br>
                </div>
        </div>
        <div class="card-footer text-muted">
            <input type="submit"  class="btn btn-primary btn-block" value="Ajouter" name="ajouterCat" />
        </div>
        </form>
    </div>

    <div class="card w-25">
        <div class="card-header">
            <h5>Supprimer une catégorie</h5>
        </div>
        <div class="card-body mx-3">
            <form action="<?= $_SERVER['PHP_SELF']?>" method="post" >
                <div class="form-group">
                    <label for="cat">Nom de la catégorie </label>
                    <select id="cat" class="form-control" name="cat" required>
                        <?php foreach ($cats as $cat){echo "<option value=\"" . $cat['nom'] . "\">" . $cat['nom'] . "</option>";} ?>
                    </select></br>
                </div>
        </div>
        <div class="card-footer text-muted">
            <input class="btn btn-primary btn-block" type="submit" value="Supprimer" name="supprimerCat" />
        </div>
        </form>
    </div>
</div>