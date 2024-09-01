<?php

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/vendor/autoload.php');

// pr afficher les erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);
//pr indiquer que la repose sera en json
header('Content-Type: application/json');

try {
  // Connexion à la bdd mongodb
  $database = connexionArcadiaMongoBDD();
  $collection = $database->selectCollection('animal');

  // Récupérer les données envoyées via la requête POST
  $data = json_decode(file_get_contents('php://input'), true);

  //verification si nom présent sinon exception
  if (!isset($data['nom'])) {
    throw new Exception('Le nom de l\'animal est manquant.');
  }

  $nom = $data['nom'];

  // Requête pour incrémenter le compteur de consultations
  $result = $collection->updateOne(
    ['nom' => $nom],
    ['$inc' => ['consultations' => 1]]
  );
  //verification
  if ($result->getModifiedCount() > 0) {
    // Renvoie une réponse JSON indiquant le succès
    echo json_encode(['success' => true, 'message' => "Consultations incrementé pour $nom"]);
  } else {
    throw new Exception("Animal $nom non trouvé ou aucun changement effectué.");
  }
} catch (Exception $e) {
  echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
