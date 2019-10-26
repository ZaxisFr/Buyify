<?php if (isset($erreur)): ?>
    <p class="bg-danger banner" xmlns="http://www.w3.org/1999/html"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
<?php endif; ?>
<?php if (isset($succes)): ?>
    <p class="bg-success banner">Opération effectuée <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
<?php endif;?>

<div id="categorie-body" class="container_fluid">
    <div class="card w-25">
        <div class="card-header">
            <h5>Ajouter une catégorie</h5>
        </div>
        <div class="card-body mx-3">
            <form action="<?= $_SERVER['PHP_SELF']?>" method="post" >
                <div class="form-group">
                    <label for="cat-name">Nom de la catégorie </label>
                    <input  class="form-control" type="text" name="cat_name" id="cat-name" required> </br>
                </div>
                <div class="form-group">
                    <label for="parent">Catégorie parente</label>
                    <select  class="form-control" id="parent" name="parent" required>
                        <?php foreach ($cats as $cat){ ?>
                        <option value="<?= $cat['nom'] ?>"><?= $cat['nom'] ?></option>
                        <?php } ?>
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
            <form id="supp" action="<?= $_SERVER['PHP_SELF']?>" method="post" >
                <div class="form-group">
                    <label for="cat">Nom de la catégorie </label>
                    <select id="cat" class="form-control" name="cat" required>
                        <?php foreach ($cats as $cat){ ?>
                            <option value="<?= $cat['nom'] ?>"><?= $cat['nom'] ?></option>
                        <?php } ?>
                    </select></br>
                </div>
        </div>
        <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#confirmation-popup">
                Supprimer
            </button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="confirmation-popup" tabindex="-1" role="dialog" aria-labelledby="confirmation-popup" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-Label">Confirmer la suppression</h5>
                </button>
            </div>
            <div class="modal-body">
                <h5>ATTENTION !! </h5>
                <p>La suppression est définitive, les données ne seront pas récupérables.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button form="supp" class="btn btn-primary btn-block" type="submit" value="Supprimer" name="supprimerCat" /> Confirmer </button>
            </div>
        </div>
    </div>
</div>
