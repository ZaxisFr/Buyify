<?php
/*
 * param : {Produit : $produit}
 * ----------------------- OU -----------------------
 * param : {int : $id
 *          string : $intitule
 *          string : $description
 *          string : $photo
 *          string : $vendeur
 *          int : $prix}
 * NOTE : Les parametre specifié individuelement ecraserons ceux de produit
 */
require_once ('../model/Produit.class.php');
require_once ('../model/Utilisateur.class.php');
$_SESSION['prevurl'] = $_SERVER['REQUEST_URI'];
?>

<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
    <div class="card carte-produit">
        <div class="card-header">
            <a href=""><h5 class="card-title"><?=$intitule??$produit->getIntitule()?></h5></a>
            <?php if(Utilisateur::isConnecte()):?>
                <a href="toggleFavori.ctrl.php?id=<?=$id??$produit->getId()?>"><span class="<?= Utilisateur::getUtilisateurConnecte()->isFavori($id??$produit->getId())?'fas':'far'?> fa-star"></span></a>
            <?php endif;?>
        </div>
        <div class="div-responsive-wrapper ratio-16-9">
            <a href="" class="div-responsive"><img src="../model/data/images/<?=$description??$produit->getPhoto()?>" alt="" class=" img-responsive embed-responsive-item"></a>
        </div>
        <div class="card-body">
            <p class="card-text description"><?=$produit->getDescription()?></p>
            <a href=""><h6 class="card-subtitle text-muted text-right"><?=$vendeur??Utilisateur::getUtilisateurParId($produit->getVendeur())->getNom()?> <?=isset($vendeur)?'':Utilisateur::getUtilisateurParId($produit->getVendeur())->getPrenom()?></h6></a>
        </div>
        <div class="card-footer">
            <a href="" class="btn-primary">Contacter</a>
            <p class="card-text text-right"><?=$prix??$produit->getPrix()?>€</p>
        </div>
    </div>
</div>