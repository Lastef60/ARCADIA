<?php
require_once(__DIR__ . '/config/env.php'); //apport des const env.php
require_once(__DIR__ . '/vendor/autoload.php');

use MongoDB\Client;

function connexionBDD()
{
  // try-catch pour attraper les erreurs de connexion
  try {
    $pdo = new PDO(
      sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_ARCADIA_HOST, DB_ARCADIA_PORT, DB_ARCADIA_NAME),
      DB_ARCADIA_USER,
      DB_ARCADIA_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // def le mode d'erreur en mode Exception
    return $pdo; //retourne l'objet PDO sinon pb dans uplaod.php
    //echo('connexion réussie');
  } catch (Exception $exception) {
    //eeror_log suivant pour ne pas afficher les données sensibles ex mdp
    error_log('Erreur de connexion à la base de données : ' . $exception->getMessage());
    die('Erreur : ' . $exception->getMessage());
  }
}

function ajouterUtilisateur($username, $password, $nom, $prenom, $role_id)
{
    $pdo = connexionBDD();

    if ($password === null) {
        throw new Exception('Le mot de passe ne peut pas être nul.');
    }

    // hashage mdp avec SHA2
    $hashed_password = hash('sha256', $password);

    // insertion des données (preparation + execution)
    $stmt = $pdo->prepare('INSERT INTO utilisateur (username, password, nom, prenom, role_id) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$username, $hashed_password, $nom, $prenom, $role_id]);

    // Fermer la connexion
    $pdo = null;
}

function supprimerUtilisateur($username)
{
    // Vérification si le nom d'utilisateur est fourni
    if (empty($username)) {
        throw new Exception('Le nom d\'utilisateur ne peut pas être vide.');
    }

    $pdo = connexionBDD();

    try {
        // Préparation de la requête pour supprimer l'utilisateur
        $stmt = $pdo->prepare('DELETE FROM utilisateur WHERE username = ?');
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 0) {
            throw new Exception('Aucun utilisateur trouvé avec ce nom d\'utilisateur.');
        }

        echo "Utilisateur supprimé avec succès.";
    } catch (Exception $e) {
        echo 'Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage();
    } finally {
        // Fermer la connexion
        $pdo = null;
    }
}

//connexion bdd nosql mongodb
// Connexion à la base de données MongoDB
function connexionArcadiaMongoBDD()
{
    try {
        // Construction de l'URI de connexion avec les variables d'environnement
        $uri = sprintf('mongodb://%s:%s', DB_MONGO_HOST, DB_MONGO_PORT);
        $client = new MongoDB\Client($uri);
        
        // Sélection de la base de données
        $database = $client->selectDatabase('stephaniet_arcadia');
        
        echo "Connexion MongoDB réussie.";
        
        // Test optionnel de la collection 'animal'
        $collection = $database->selectCollection('animal');
        $result = $collection->findOne();
        if ($result) {
            echo "Test de collection réussi.";
        } else {
            echo "La collection 'animal' est vide ou n'existe pas.";
        }

        return $database;
    } catch (Exception $e) {
        echo 'Erreur de connexion MongoDB : ' . $e->getMessage();
        return null; 
    }
}


//fonction pour les animaux de habitats.php : recup des données à afficher des animaux
function fichierAnimal($pdo)
{
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

function ajouterRapportVeto($date, $detail, $etat_animal, $nourriture, $grammage, $prenom_animal)
{
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

function modifierHabitat($nom, $description, $commentaire_habitat, $nom_habitat)
{
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
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  } finally {
    $pdo = null;
  }
}

function recupAvis()
{
  $pdo = connexionBDD();
  //requete recup avis dans bdd
  $queryAvis = $pdo->prepare("SELECT pseudo, commentaire, date_publication FROM avis ORDER BY date_publication DESC LIMIT 5");
  // ORDER BY date DESC LIMIT 5 = selection des 5 derniers avis
  $queryAvis->execute();
  $avisVisiteurs = $queryAvis->fetchAll(PDO::FETCH_ASSOC);
  // Fermer la connexion
  $pdo = null;
  return $avisVisiteurs;
}
