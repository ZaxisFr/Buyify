<div class="favori">

    <!-- <span><h2><span class="fas fa-star"> </span><span class="h2-content">Favoris :</span></h2></span> -->

    <div class="row">
        <?php
            foreach ($this->param['produitsFavoris'] as $produit){
                Layer::displayStatique('carteProduit.layer.php',['produit'=>$produit]);
            }
        ?>
    </div>
    <script>
        function ellipsizeTextBox(id) {
            var el = document.getElementById(id);
            var wordArray = el.innerHTML.split(' ');
            while(el.scrollHeight > el.offsetHeight) {
                wordArray.pop();
                el.innerHTML = wordArray.join(' ') + '...';
            }
        }
        ellipsizeTextBox('description')
    </script>
</div>