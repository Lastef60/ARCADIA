<?php
require_once(__DIR__.'/functions.php');

// Appel de la fonction pour se connecter à la BDD
$pdo = connexionBDD();

//Appel de la fonction pour supprimer un utilisateur
try{
  supprimerUtilisateur($username);
  echo "Utilisateur supprimé avec succès.";
}catch (Exception $exception) {
  echo "Erreur lors de la suppression de l'utilisateur : " .$exception->getMessage();
}
