<?php
require_once(__DIR__.'/functions.php');
require_once(__DIR__.'/variables.php'); //y compris variables pr recup données du form
// Appel de la fonction pour se connecter à la BDD
$pdo = connexionBDD();

//verif soumission du formulaire
if (isset($_POST['upload'])) {
  //verif si telechargement ok
  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    //recup des données de l'img
    $image= $_FILES['image']['tmp_name'];
    $image_data = file_get_contents($image);//lecture du contenu de l'img
    $image_name = $_POST['image_name']; // recup image_name de l'img soumis dans le form

    try{
      //prepa et execution requete sql envoi bdd
      $stmt = $pdo->prepare("INSERT INTO image(image_data, image_name) VALUES (:image_date, :image_name)");
      $stmt->bindParam(':image_data', $image_data, PDO::PARAM_LOB); //lier les données de l'image
      $stmt->bindParam(':image_name', $image_name, PDO::PARAM_STR); //lier le nom de l'image
      //$stmt->execute();executer la requete pas besoin de l'utiliser quand on utilise des bindParam
      echo "L'image a été enregsitrée avec succès dans la base de données.";

      //il faut indiquer le chemin du telechargement pour le retrouver dans le dossier
      $upload_dir = 'uploads/img/';

      //definition du chemin complet du fichier à telecharger
      $upload_file = $upload_dir . basename($_FILES['image']['name']);

      //on déplace le fichier télécharger vers le repertoire de telechargment
      if(move_uploaded_file($image, $upload_file)) {
        echo "l'image a été telechargée et enregistrée avec succès.";
      }else{
        echo "une erreur s'est produite lors du déplacement de l'image.";
      }
    }catch (PDOException $e){
      //gérer les erreurs de telechargement de fichier
      echo "Erreur lors de l'insertion dans la base de donnée : " . $e->getMessage();
    }

  }else{
    echo "Erreur de téléchargement : " . $_FILES['image']['error'];
  }
}else{
  echo "Le formulaire n'a pas été envoyé.";
}