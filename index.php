<?php

// Charger les fichiers nécessaires
require_once(__DIR__ . '/config/env.php');
require_once(__DIR__ . '/src/models/Database.php');
require_once(__DIR__ . '/src/controllers/ServiceController.php');
require_once(__DIR__ . '/src/controllers/HabitatController.php');
require_once(__DIR__ . '/src/controllers/AnimalController.php');
require_once(__DIR__ . '/src/controllers/AvisController.php');

// Créer une instance de la base de données
$db = new Database();

// Récupérer l'URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Définir les routes pour la page d'accueil et les autres pages
if ($url === '') {
    // Charger les données nécessaires pour l'accueil
    $serviceController = new ServiceController($db->getPdo());
    $services = $serviceController->list();

    $avisController = new AvisController($db->getPdo());
    $avisVisiteurs = $avisController->list();

    // Charger la page d'accueil
    require_once(__DIR__ . '/src/views/accueil.php');
    exit;
} elseif ($url === 'services') {
    $serviceController = new ServiceController($db->getPdo());
    $services = $serviceController->list();
    require_once(__DIR__ . '/src/views/service.php');
    exit;
} elseif ($url === 'habitats') {
    $habitatController = new HabitatController($db->getPdo());
    $habitats = $habitatController->list();
    require_once(__DIR__ . '/src/views/habitat/list.php');
    exit;
} elseif (preg_match('/^habitat\/(\d+)$/', $url, $matches)) {
    $habitatController = new HabitatController($db->getPdo());
    $habitat = $habitatController->show($matches[1]);
    require_once(__DIR__ . '/src/views/habitat/show.php');
    exit;
}

// Routes pour les avis
$avisController = new AvisController($db->getPdo());
echo "AvisController initialisé.<br>";

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        require_once(__DIR__ . '/src/views/avis/list.php');
        echo "Liste des avis chargée.<br>";
        exit;

    case 'create':
        require_once(__DIR__ . '/src/views/avis/create.php');
        echo "Formulaire de création d'avis chargé.<br>";
        exit;

    case 'update':
        if (isset($_GET['id'])) {
            require_once(__DIR__ . '/src/views/avis/update.php');
            echo "Formulaire de mise à jour pour l'avis ID {$_GET['id']} chargé.<br>";
        } else {
            echo "ID de l'avis manquant pour la mise à jour.<br>";
        }
        exit;

    case 'delete':
        if (isset($_GET['id'])) {
            require_once(__DIR__ . '/src/views/avis/delete.php');
            echo "Formulaire de suppression pour l'avis ID {$_GET['id']} chargé.<br>";
        } else {
            echo "ID de l'avis manquant pour la suppression.<br>";
        }
        exit;

    default:
        http_response_code(404);
        echo 'Action non reconnue, liste des avis affichée.<br>';
        require_once(__DIR__ . '/src/views/avis/list.php');
        exit;
}

echo "Fin du script.<br>";
exit;
