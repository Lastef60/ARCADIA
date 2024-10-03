<?php

require_once(__DIR__ . '/../core/Database.php'); // Charger la classe de base de données
require_once(__DIR__ . '/../core/AnimalCounter.php'); // Charger la classe AnimalCounter

// Pour afficher les erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Pour indiquer que la réponse sera en JSON
header('Content-Type: application/json');

try {
    // Connexion à la BDD MongoDB
    $database = new Database();
    $mongoClient = $database->getMongoClient();
    $animalCounter = new AnimalCompteur($mongoClient); // Créer une instance de la classe AnimalCounter

    // Récupérer les données envoyées via la requête POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérification si le nom est présent sinon lancer une exception
    if (!isset($data['nom'])) {
        throw new Exception('Le nom de l\'animal est manquant.');
    }

    $nom = $data['nom'];

    // Appel à la méthode pour incrémenter les consultations
    $response = $animalCounter->incrementConsultation($nom);

    // Renvoie la réponse JSON indiquant le succès
    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
