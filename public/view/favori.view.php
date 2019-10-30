<div class="favori">

    <!-- <span><h2><span class="fas fa-star"> </span><span class="h2-content">Favoris :</span></h2></span> -->

    <div class="row">
        <?php
            foreach ($this->param['produitsFavoris'] as $produit){
                include("../view/template/carteProduit.template.php");
            }
        ?>
    </div>
    <script type="text/javascript" src="../view/scripts/multiLineElipsisText.js"></script>
</div>
