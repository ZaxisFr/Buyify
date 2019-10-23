<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Buyifi</title>
  </head>
  <body>
  <?php if (isset($this->param['succes'])): ?>
    <div class="succes">
      <p>Ajout reussis</p>
    </div>
  <?php endif; ?>
  <?php if (isset($this->param['error'])): ?>
    <div class="error">
      <p><?= $this->param['error'] ?></p>
    </div>
  <?php endif; ?>
  <div class="">
    <form class="" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data"><br>
      <label for="intitule">intitule</label> <input type="text" name="intitule" value=""><br>
      <label for="description">description</label> <input type="text" name="description" value=""><br>
      <label for="prix">prix</label> <input type="text" name="prix" value=""><br>
      <label for="categorie">catégorie</label>
      <select class="" name="categorie">
        <?php foreach ($this->param['categories'] as $categorie): ?>
          <option value="<?=$categorie['nom']?>"><?=$categorie['nom']?></option>
        <?php endforeach; ?>
      </select>
      <br>
      <label for="imageURL">images</label> <input type="text" name="imageURL" value="">
      <input type="file" name="image" value="" id="image"><br/>
      <button type="submit" name="ajout" value="envoie">envoie</button>
    </form>
  </div>
  </body>
</html>
