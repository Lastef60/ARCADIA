<?php

// Charger les fichiers nécessaires
require_once(__DIR__ . '/config/env.php');
require_once(__DIR__ . '/src/models/Database.php'); // Ajouter la classe Database ici
require_once(__DIR__ . '/src/controllers/ServiceController.php');
require_once(__DIR__ . '/src/controllers/HabitatController.php');
require_once(__DIR__ . '/src/controllers/AnimalController.php');
require_once(__DIR__ . '/src/controllers/AvisController.php');

// Créer une instance de la base de données
$db = new Database(); // Instanciation de Database

// Récupérer l'URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Définir les routes
if ($url === '') {
    $serviceController = new ServiceController($db->getPdo());
    $serviceController->list();
} elseif ($url === 'services') {
    $serviceController = new ServiceController($db->getPdo());
    $serviceController->list();
} elseif ($url === 'habitats') {
    $habitatController = new HabitatController($db->getPdo());
    $habitatController->list();
} elseif (preg_match('/^habitat\/(\d+)$/', $url, $matches)) {
    $habitatController = new HabitatController($db->getPdo());
    $habitatController->show($matches[1]);
} elseif ($url === 'habitat/create') {
    $habitatController = new HabitatController($db->getPdo());
    $habitatController->create();
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'animal') {
    $animalController = new AnimalController($db->getPdo());
    switch ($_GET['action']) {
        case 'list':
            $animalController->list($_GET['habitat_id']);
            break;
        case 'show':
            $animalController->show($_GET['id']);
            break;
        case 'create':
            $animalController->create();
            break;
        case 'edit':
            $animalController->edit($_GET['id']);
            break;
        case 'delete':
            $animalController->delete($_GET['id']);
            break;
        default:
            http_response_code(404);
            echo 'Action non trouvée';
            break;
    }
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'avis') {
    $avisController = new AvisController($db->getPdo());
    $action = $_GET['action'] ?? 'list';
    switch ($action) {
        case 'list':
            require_once(__DIR__ . '/src/views/avis/list.php');
            break;
        case 'create':
            require_once(__DIR__ . '/src/views/avis/create.php');
            break;
        case 'update':
            if (isset($_GET['id'])) {
                require_once(__DIR__ . '/src/views/avis/update.php');
            } else {
                echo "ID de l'avis manquant pour la mise à jour.";
            }
            break;
        case 'delete':
            if (isset($_GET['id'])) {
                require_once(__DIR__ . '/src/views/avis/delete.php');
            } else {
                echo "ID de l'avis manquant pour la suppression.";
            }
            break;
        default:
            require_once(__DIR__ . '/src/views/avis/list.php');
            break;
    }
} else {
    http_response_code(404);
    echo 'Page non trouvée';
}
