
<div class="container_fluid formulaire-ajout-produit">
  <?php if (isset($this->param['error'])): ?>
        <p class="bg-danger banner"><?= $this->param['error'] ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
  <?php endif; ?>

  <?php if (isset($this->param['succes'])): ?>
      <p class="bg-success banner">Votre annonce a été enregistrée. <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
  <?php endif; ?>
  <article class="card-body mx-auto">
    <form class="" action="<?= $_SERVER['REQUEST_URI'] ?><?=isset($produit)? '&id='.$produit->getId() : ''?>" method="post" enctype="multipart/form-data">
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-heading"></span> </span>
        </div>
        <label for="intitule" class="d-none">Intitulé</label>
        <input type="text" name="intitule" id="intitule" placeholder="Intitulé" class="form-control" value="<?=isset($produit)?$produit->getIntitule():''?>">
      </div>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-align-justify"></span> </span>
        </div>
        <label for="description" class="d-none">description</label>
        <textarea name="description" id="description" placeholder="Description" class="form-control"><?=isset($produit)?$produit->getDescription():''?></textarea>
      </div>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-euro-sign"></span> </span>
        </div>
        <label for="prix" class="d-none">prix</label>
        <input type="number" id="prix" name="prix" placeholder="Prix" class="form-control" value="<?=isset($produit)?$produit->getPrix():''?>">
      </div>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-list"></span> </span>
        </div>
        <label for="categorie" class="d-none">catégorie</label>
        <select name="categorie" id="categorie" class="form-control">
          <option value="" <?=isset($produit)?'':'selected'?>>Catégorie</option>
          <?php foreach ($this->param['categories'] as $categorie): ?>
            <option value="<?=$categorie['nom']?>" <?=(isset($produit)&&$produit->getCategorie()==$categorie['nom'])?'selected':''?> ><?=$categorie['nom']?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupFileAddon01"><span class="fas fa-image"></span></span>
        </div>
        <div class="custom-file">
          <input type="file" id="image" class="custom-file-input"
            aria-describedby="inputGroupFileAddon01" name="image" id="image">
          <label class="custom-file-label" for="image">Sélectionner photo</label>
        </div>
        <script>
            $('#image').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                fileName = fileName.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
      </div>
      <div style="position: relative; width: auto; height: 0">
        <p class="text-right file-condition">limite de 2 Mo</p>
      </div>
      <p class="ou"><span>OU</span></p>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-image"></span> </span>
        </div>
        <label for="image-url" class="d-none">image</label>
        <input type="text" name="image-url" id="image-url" class="form-control" value="" placeholder="Entrez URL">
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="ajout" value="valider">Valider</button>
    </form>
  </div>
  </body>

</div>
