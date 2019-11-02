<div id="produit" class="container_fluid">
    <div class="col-12 col-sm-10">
        <div class="card carte-produit">
            <div class="card-header">
                <h5 class="card-title text-multiline-elipsis"><?= $intitule ?? $produit->getIntitule() ?></h5>
                <p class="card-text"><small class="text-muted">Catégorie : <?= $produit->getCategorie() ?></small></p>
            </div>
            <div class="div-responsive-wrapper ratio-16-9">
                <a href="../model/data/images/<?= $description ?? $produit->getPhoto() ?>" class="div-responsive"><img
                        src="../model/data/images/<?= $description ?? $produit->getPhoto() ?>" alt=""
                        class=" img-responsive embed-responsive-item"></a>
            </div>
            <hr>
            <div class="card-body">
                <p class="card-text description text-multiline-elipsis"> Description : <?= $produit->getDescription() ?></p>
                <a href=""><h6
                        class="card-subtitle text-muted text-right"><?= $vendeur ?? Utilisateur::getUtilisateurParId($produit->getVendeur())->getNom() ?> <?= isset($vendeur) ? '' : Utilisateur::getUtilisateurParId($produit->getVendeur())->getPrenom() ?></h6>
                </a>
            </div>
            <div class="card-footer">
                <a href="" class="btn-primary">Contacter</a>
                <p class="card-text text-right"><?= $prix ?? $produit->getPrix() ?> €</p>
            </div>
        </div>
    </div>
</div>
