<?php
require_once(__DIR__.'/functions.php');
require_once(__DIR__.'/variables.php'); //y compris variables pr recup données du form
// Appel de la fonction pour se connecter à la BDD
$pdo = connexionBDD();

// Appel de la fonction pour ajouter un utilisateur
try {
  ajouterUtilisateur($username, $password, $nom, $prenom, $role_id);
  echo "Utilisateur ajouté avec succès.";
} catch (Exception $exception) {
  echo "Erreur lors de l'ajout de l'utilisateur : " . $exception->getMessage();
}
