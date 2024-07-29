<?php
require_once(__DIR__ . '/config/env.php'); //apport des const env.php

function connexionBDD() {
  // try-catch pour attraper les erreurs de connexion
  try {
    $pdo = new PDO(
      sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_ARCADIA_HOST, DB_ARCADIA_PORT, DB_ARCADIA_NAME),
      DB_ARCADIA_USER,
      DB_ARCADIA_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // définir le mode d'erreur en mode Exception
    return $pdo;//retourne l'objet PDO sinon pb dans uplaod.php
    //echo('connexion réussie');
  } catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
  }
}

function ajouterUtilisateur($username, $password, $nom, $prenom, $role_id) {
  $pdo = connexionBDD();
  
  // hashage mdp avec SHA2
  $hashed_password = hash('sha256', $password);
  
  // insertion des données (preparation + execution)
  $stmt = $pdo->prepare('INSERT INTO utilisateur (username, password, nom, prenom, role_id) VALUES (?, ?, ?, ?, ?)');
  $stmt->execute([$username, $hashed_password, $nom, $prenom, $role_id]);
  
  // Fermer la connexion
  $pdo = null;
}

function supprimerUtilisateur($username) {
  $pdo = connexionBDD();
  
  // suppression des données (preparation + execution)
  $stmt = $pdo->prepare('DELETE FROM utilisateur WHERE username = ?');
  $stmt->execute([$username]);
  
  // Fermer la connexion
  $pdo = null;
}

function connexionArcadiaMongoBDD() {
  // try-catch pour attraper les erreurs de connexion
  try {
    $pdo = new PDO(
      sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_MONGO_HOST, DB_MONGO_PORT, DB_MONGO_NAME),
      DB_MONGO_USER,
      DB_MONGO_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // définir le mode d'erreur en mode Exception
    return $pdo;//retourne l'objet PDO sinon pb dans uplaod.php
    //echo('connexion réussie');
  } catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
  }
}
//fonction pour les animaux de habitats.php : recup des données à afficher des animaux
function fichierAnimal($pdo) {
  // Préparation de la requête
  $queryAnimals = $pdo->prepare(
      "SELECT
          a.prenom,
          a.genre,
          a.age,
          a.etat AS historique,
          r.label AS race,
          rv.etat_animal AS rapport_veterinaire
      FROM animal a
      JOIN rapport_veterinaire rv ON a.animal_id = rv.animal_id
      JOIN race r ON a.race_id = r.race_id"
  );

  // Exécution de la requête
  if (!$queryAnimals->execute()) {
      // Affichage des erreurs SQL
      $errorInfo = $queryAnimals->errorInfo();
      echo "SQL Error: " . htmlspecialchars($errorInfo[2]);
      exit;
  }

  // Récupération des résultats
  return $queryAnimals->fetchAll(PDO::FETCH_ASSOC);
}
