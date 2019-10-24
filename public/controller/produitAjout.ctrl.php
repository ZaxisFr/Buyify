
<?php

function chaineValide(string $chaine) : bool {
    return isset($chaine) && strlen(trim($chaine)) > 0;
}

function setError(View $view, string $message){
  $view->assign("error",$message);
}

function verifierAjoutProduit(View $view, array $info, DAO $db){
  if(!chaineValide($intitule = $info['intitule'] ?? '')){
    setError($view, "Veuillez renseigner l'intitulé");
    return;
  }
  if(!chaineValide($description = $info['description'] ?? '')){
    setError($view, "Veuillez renseigner la description");
    return;
  }
  if(!chaineValide($prix = $info['prix'] ?? '')){
    setError($view, "Veuillez renseigner le prix");
    return;
  }
  if(!chaineValide($categorie = $info['categorie'] ?? '')){
    setError($view, "Veuillez renseigner la categorie");
    return;
  }
    if(!chaineValide($imageUrl = $info['imageURL'] ?? '')or isset($_FILES)){
      setError($view, "Veuillez fournir une image");
      return;
  }
    $image = $_FILES;
    if(chaineValide($info['imageURL'])){
      $imageUrl = $info['imageURL'];
      if (!ImageUpload::retrieveImage($imageUrl)) {
          return;
      }
  }else{
      if (!ImageUpload::uploadImage($image['image'],2000000)) {
          printf("test 123");
          if (ImageUpload::getErrorMessage() == "size") {
              setError($view,"La taille de l'image ne doit pas dépasser 2Mo");
          }else {
              setError($view, "Erreur de l'envoi de l'image");
          }
          return;
      }
  }
    $imageName = ImageUpload::getNewFileName();

    $idUtilisateur = Utilisateur::getUtilisateurConnecte()->getId();

    $db->run("INSERT INTO Produit ('intitule', 'description', 'prix', 'categorie', 'photo', 'vendu-par') VALUES (:intitule, :description, :prix, :categorie, :image, :venduPar)", [
      'intitule' => $intitule,
      'description' => $description,
      'prix' => $prix,
      'categorie' => $categorie,
      'image' => $imageName,
      'venduPar' => $idUtilisateur
  ]);


    header('Location: ajout-produit.ctrl.php?success=true');
    exit(0);
}

require_once('../../framework/View.class.php');
$view = new View();

require_once('../model/ImageUpload.class.php');
require_once('../model/DAO.class.php');
$db = new Dao();

require_once('../model/Utilisateur.class.php');



$categories = $db->select('Categorie','1',[],'nom');

$view->assign("categories", $categories);

session_start();

if (isset($_POST['ajout'])) {
    verrifierAjoutProduit($view, $_POST ,$db);
}
if (isset($_GET['success']) && filter_var($_GET['success'], FILTER_VALIDATE_BOOLEAN)) {
    $view->assign("succes", true);
}
$view->setTitle('Ajouter Produit');
$view->display('produitAjout.view.php');
 ?>
