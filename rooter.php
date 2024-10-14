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
if ($uri === '/' || $uri === '/index.php') {
    require_once(__DIR__ . '/src/views/accueil.php');
} elseif ($uri === '/habitats') {
    $habitatController->list();
} elseif (preg_match('/^\/habitat\/(\d+)$/', $uri, $matches)) {
    $habitatController->show($matches[1]);
} else {
    http_response_code(404);
    echo "404 - Page non trouvée";
}

