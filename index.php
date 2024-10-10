<?php

// Charger les fichiers nécessaires
require_once(__DIR__ . '/config/env.php');
echo "Fichier env.php chargé.<br>";
require_once(__DIR__ . '/src/models/Database.php');
echo "Fichier Database.php chargé.<br>";
require_once(__DIR__ . '/src/controllers/ServiceController.php');
echo "ServiceController chargé.<br>";
require_once(__DIR__ . '/src/controllers/HabitatController.php');
echo "HabitatController chargé.<br>";
require_once(__DIR__ . '/src/controllers/AnimalController.php');
echo "AnimalController chargé.<br>";
require_once(__DIR__ . '/src/controllers/AvisController.php');
echo "AvisController chargé.<br>";

// Créer une instance de la base de données
$db = new Database();
echo "Instance de Database créée.<br>";

// Récupérer l'URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
echo "URL récupérée: $url<br>";

// Définir les routes pour la page d'accueil et les autres pages
if ($url === '') {
    // Charger les données nécessaires pour l'accueil
    $serviceController = new ServiceController($db->getPdo());
    $services = $serviceController->list();

    $avisController = new AvisController($db->getPdo());
    $avisVisiteurs = $avisController->list();

    // Charger la page d'accueil
    require_once(__DIR__ . '/src/views/accueil.php');
    echo "Page d'accueil chargée.<br>";
    exit;
} elseif ($url === 'services') {
    $serviceController = new ServiceController($db->getPdo());
    $services = $serviceController->list();
    require_once(__DIR__ . '/src/views/service.php');
    echo "Liste des services chargée.<br>";
    exit;
} elseif ($url === 'habitats') {
    $habitatController = new HabitatController($db->getPdo());
    $habitats = $habitatController->list();
    require_once(__DIR__ . '/src/views/habitat/list.php');
    echo "Liste des habitats chargée.<br>";
    exit;
} elseif (preg_match('/^habitat\/(\d+)$/', $url, $matches)) {
    $habitatController = new HabitatController($db->getPdo());
    $habitat = $habitatController->show($matches[1]);
    require_once(__DIR__ . '/src/views/habitat/show.php');
    echo "Habitat avec ID {$matches[1]} chargé.<br>";
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
