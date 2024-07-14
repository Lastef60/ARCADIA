<?php
require_once(__DIR__ . '/config/env.php'); //apport des const env.php

function connexionBDD() {
  // try-catch pour attraper les erreurs de connexion
  try {
    $pdo = new PDO(
      sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME),
      DB_USER,
      DB_PASSWORD
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