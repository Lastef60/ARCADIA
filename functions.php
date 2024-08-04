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
//connexion bdd nosql mongodb
//function connexionArcadiaMongoBDD() {
    // $client = new MongoDB\Client("mongodb://localhost:27017");
    //return $client->arcadia_mongodb;
//}


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

function ajouterRapportVeto($date, $detail, $etat_animal, $nourriture, $grammage, $prenom_animal) {
  $pdo = connexionBDD();
  try {
    // ID de l'animal à partir du prénom car veto ne connait pas l'ID
    $stmt = $pdo->prepare('SELECT animal_id FROM animal WHERE prenom = ?');
    $stmt->execute([$prenom_animal]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$animal) {
      throw new Exception('Animal non trouvé avec le prénom donné.');
    }

    $animal_id = $animal['animal_id'];

    // Requête pour insérer le rapport vétérinaire
    $stmt = $pdo->prepare('INSERT INTO rapport_veterinaire (date, detail, etat_animal, nourriture, grammage, animal_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$date, $detail, $etat_animal, $nourriture, $grammage, $animal_id]);
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  } finally {
    // Fermer la connexion
    $pdo = null;
  }
}

function modifierHabitat ($nom, $description, $commentaire_habitat, $nom_habitat) {
  $pdo = connexionBDD();
  try {
    //id habitat pour reconnaitre avec le nom de l'habitat
    $stmt = $pdo->prepare('SELECT habitat_id FROM habitat WHERE nom = ?');
    $stmt->execute([$nom_habitat]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$habitat) {
      throw new Exception('habitat non trouvé avec le nom donné');
    }
    $habitat_id = $habitat['habitat_id'];
    //requete pour modifier les données de l'habitat
    $stmt = $pdo->prepare('UPDATE habitat SET nom = ?, description = ?, commentaire_habitat = ? WHERE habitat_id = ?');
    $stmt->execute([$nom, $description, $commentaire_habitat, $habitat_id]);
  }catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  } finally{
    $pdo = null;
  }
}
 