
<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
    <div class="card carte-produit">
        <div class="card-header">
            <a href=""><h5 class="card-title text-multiline-elipsis"><?=$intitule??$produit->getIntitule()?></h5></a>
            <?php if(Utilisateur::isConnecte()):?>
                <a href="toggleFavori.ctrl.php?id=<?=$id??$produit->getId()?>"><span class="<?= Utilisateur::getUtilisateurConnecte()->isFavori($id??$produit->getId())?'fas':'far'?> fa-star"></span></a>
            <?php endif;?>
        </div>
        <div class="div-responsive-wrapper ratio-16-9">
            <a href="" class="div-responsive"><img src="../model/data/images/<?=$description??$produit->getPhoto()?>" alt="" class=" img-responsive embed-responsive-item"></a>
        </div>
        <div class="card-body">
            <p class="card-text description text-multiline-elipsis"><?=$produit->getDescription()?></p>
            <a href=""><h6 class="card-subtitle text-muted text-right"><?=$vendeur??Utilisateur::getUtilisateurParId($produit->getVendeur())->getNom()?> <?=isset($vendeur)?'':Utilisateur::getUtilisateurParId($produit->getVendeur())->getPrenom()?></h6></a>
        </div>
        <div class="card-footer">
            <div>
                <button type="button" class="btn-icon" data-toggle="modal" data-target="#ModalEdit<?=$produit->getId()?>"><i class="fas fa-edit" aria-hidden="true"></i></button>
                <button type="button" class="btn-icon" data-toggle="modal" data-target="#ModalSuppression<?=$produit->getId()?>"><i class="fas fa-trash"></i></button>
            </div>
            <p class="card-text text-right"><?=$prix??$produit->getPrix()?>€</p>
        </div>
    </div>
    <div class="modal fade" id="ModalSuppression<?=$produit->getId()?>" tabindex="-1" role="dialog" aria-labelledby="ModalSuppression<?=$produit->getId()?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalSuppressionLabelLong<?=$produit->getId()?>">Supression</h5>
                    <button type="button" class="btn-icon" data-toggle="modal" data-target="#ModalSuppression<?=$produit->getId()?>"">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Confirmez-vous la suppression du produit ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModalSuppression<?=$produit->getId()?>">Fermer</button>
                    <a class="btn btn-danger" href="supprimerProduit.ctrl.php?id=<?=$produit->getId()?>"><i class="fas fa-trash"></i> Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEdit<?=$produit->getId()?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit<?=$produit->getId()?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditLabel<?=$produit->getId()?>">Modification du produit</h5>
                    <button type="button" class="btn-icon" data-toggle="modal" data-target="#ModalEdit<?=$produit->getId()?>" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Confirmez-vous la modification du produit ? Cett action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModalEdit<?=$produit->getId()?>">Fermer</button>
                    <a class="btn btn-warning" href="produitAjout.ctrl.php?produit=<?=$produit->getId()?>"><i class="fas fa-edit" aria-hidden="true"></i> Editer</a>
                </div>
            </div>
        </div>
    </div>
</div>
