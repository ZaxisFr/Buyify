<div class="favori">

    <!-- <span><h2><span class="fas fa-star"> </span><span class="h2-content">Favoris :</span></h2></span> -->

    <div class="row">
        <?php
            foreach ($produitsFavoris as $produit){
                include("../view/template/carteProduit.template.php");
            }
        ?>
    </div>
    <?php if(sizeof($produitsFavoris) == 0): ?>
        <article class="fav-erreur">
            <h3>Humm ça a l'air bien vide par ici...</h3>
            <p>Vous pouvez ajouter un produit en favori en cliquant sur la petite étoile située en haut à droite d'un produit</p>
        </article>
    <?php endif; ?>
    <script type="text/javascript" src="../view/scripts/multiLineElipsisText.js"></script>
</div>
