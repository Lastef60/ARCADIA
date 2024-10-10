<?php

require_once(__DIR__ . '/src/controllers/HabitatController.php');
require_once(__DIR__ . '/src/controllers/ServiceController.php');
require_once(__DIR__ . '/src/controllers/HoraireController.php');
require_once(__DIR__ . '/src/models/Database.php');

// Créer une instance de la base de données
$db = new Database();
$pdo = $db->getPdo();

// Instancier les contrôleurs
$serviceController = new ServiceController($pdo);
$habitatController = new HabitatController($pdo);

// Récupérer l'URL de la requête
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Routes pour le site
if ($uri === '/' || $uri === '/index') {
    // Afficher la page d'accueil
    $serviceController->list();
} elseif ($uri === '/habitats') {
    // Afficher tous les habitats
    $habitatController->list();
} elseif (preg_match('/^\/habitat\/(\d+)$/', $uri, $matches)) {
    // Afficher un habitat spécifique en fonction de l'ID
    $habitatController->show($matches[1]);
} elseif ($uri === '/habitat/create') {
    // Créer un nouvel habitat
    $habitatController->create();
} elseif (preg_match('/^\/habitat\/edit\/(\d+)$/', $uri, $matches)) {
    // Mettre à jour un habitat
    $habitatController->edit($matches[1]);
} elseif (preg_match('/^\/habitat\/delete\/(\d+)$/', $uri, $matches)) {
    // Supprimer un habitat
    $habitatController->delete($matches[1]);
} else {
    // Page non trouvée
    http_response_code(404);
    echo "404 - Page non trouvée";
}
