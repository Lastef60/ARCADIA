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