<div class="mes-produits">
    <?php if(isset($succes)):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?=$succes?>
        </div>
    <?php endif;?>
    <div class="d-flex justify-content-between bar-titre align-content-center">
        <h3>Mes Produits</h3>
        <a href="produitAjout.ctrl.php" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
    </div>
    <div class="sep"></div>
    <div class="row">
        <?php
        foreach ($mesProduits as $produit){
            include("../view/template/carteProduitGestion.template.php");
        }
        ?>
    </div>
    <script type="text/javascript" src="../view/scripts/multiLineElipsisText.js"></script>

</div>