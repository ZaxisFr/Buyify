
<div class="container_fluid formulaireAjoutProduit">
  <?php if (isset($this->param['error'])): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
  <?php endif; ?>

  <?php if (isset($this->param['succes'])): ?>
      <p class="bg-success banner">Votre annonce a été enregistrée. <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
  <?php endif; ?>
  <article class="card-body mx-auto" style="max-width: 500px;">
    <form class="" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-heading"></span> </span>
        </div>
        <label for="intitule" class="d-none">intitule</label>
        <input type="text" name="intitule" placeholder="Intitulé" class="form-control" value="">
      </div>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-align-justify"></span> </span>
        </div>
        <label for="description" class="d-none">description</label>
        <textarea name="description" placeholder="Description" class="form-control" value=""></textarea>
      </div>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-euro-sign"></span> </span>
        </div>
        <label for="prix" class="d-none">prix</label>
        <input type="number" name="prix" placeholder="Prix" class="form-control" value="">
      </div>
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <span class="fas fa-list"></span> </span>
        </div>
        <label for="categorie" class="d-none">catégorie</label>
        <select name="categorie" class="form-control">
          <option value="" default>Catégorie</option>
          <?php foreach ($this->param['categories'] as $categorie): ?>
            <option value="<?=$categorie['nom']?>"><?=$categorie['nom']?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupFileAddon01"><span class="fas fa-image"></span></span>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input"
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
        <label for="imageURL" class="d-none">images</label>
        <input type="text" name="imageURL" class="form-control" value="" placeholder="Entrez URL">
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="ajout" value="valider">Valider</button>
    </form>
  </div>
  </body>

</div>
