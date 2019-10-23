
<?php

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

function setError(View $view, string $message){
  $view->assign("error",$message);
}

function verrifierAjoutProduit(View $view, array $info){
  if(!chaineValide($intitule = $info['intitule'])){
    setError($view, "veuillez renseigner l'intitulé");
    return;
  }
  if(!chaineValide($description = $info['description'])){
    setError($view, "veuillez renseigner la description");
    return;
  }
  if(!chaineValide($prix = $info['prix'])){
    setError($view, "veuillez renseigner le prix");
    return;
  }
  if(!chaineValide($categorie = $info['categorie'])){
    setError($view, "veuillez renseigner la categorie");
    return;
  }
  if(!((isset($info['imageURL'])&&chaineValide($imageUrl = $info['imageURL']))or isset($_FILES))){
    setError($view, "veuillez fournir une image");
    return;
  }
  $image = $_FILES;
  if(strlen($info['imageURL'])){
      $imageUrl = $info['imageURL'];
      if (!ImageUpload::retrieveImage($imageUrl)) {
          return;
      }
  }else{
      if (!ImageUpload::uploadImage($image['image'],2000000)) {
          printf("test 123");
          if (ImageUpload::getErrorMessage() == "size") {
              setError($view,"La taille de l'image ne dois pas depasser 2Mo");
          }else {
              setError($view, "erreur de l'envoi de l'image");
          }
          return;
      }
  }
  $imageName = ImageUpload::getNewFileName();

  $db = new Dao();

  $idUtilisateur = Utilisateur::getUtilisateurConnecte()->getId();

  try {
      $db->run("INSERT INTO Produit ('intitule', 'description', 'prix', 'categorie', 'photo', 'vendu-par') VALUES (:intitule, :description, :prix, :categorie, :image, :venduPar)", [
          'intitule' => $intitule,
          'description' => $description,
          'prix' => $prix,
          'categorie' => $categorie,
          'image' => $imageName,
          'venduPar' => $idUtilisateur
      ]);
  } catch (\Exception $e) {
  }


  header('Location: ajout-produit.ctrl.php?success=true');
  exit(0);
}

require_once('../../framework/View.class.php');
$view = new View();

require_once('../model/ImageUpload.class.php');
require_once('../model/DAO.class.php');
require_once('../model/Utilisateur.class.php');


$db = new Dao();

$categories = $db->select('Categorie','1',[],'nom');

$view->assign("categories", $categories);

session_start();

if (isset($_POST['ajout'])) {
    verrifierAjoutProduit($view, $_POST);
}
if (isset($_GET['success']) && filter_var($_GET['success'], FILTER_VALIDATE_BOOLEAN)) {
    $view->assign("succes", true);
}
$view->display('produitAjout.view.php');
 ?>
