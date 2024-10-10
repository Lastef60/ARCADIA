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

// Définir les routes pour les services, habitats, animaux, et avis
if ($url === '') {
    $serviceController = new ServiceController($db->getPdo());
    $services = $serviceController->list();
    require_once(__DIR__ . '/src/views/service.php');
    echo "Page d'accueil des services chargée.<br>";
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
} elseif ($url === 'habitat/create') {
    $habitatController = new HabitatController($db->getPdo());
    require_once(__DIR__ . '/src/views/habitat/create.php');
    echo "Formulaire de création d'habitat chargé.<br>";
    exit;
} elseif ($url === 'animals') {
    $animalController = new AnimalController($db->getPdo());
    $animals = $animalController->list($matches[1]);
    require_once(__DIR__ . '/src/views/animal/list.php');
    echo "Liste des animaux chargée.<br>";
    exit;
} elseif (preg_match('/^animal\/(\d+)$/', $url, $matches)) {
    $animalController = new AnimalController($db->getPdo());
    $animal = $animalController->show($matches[1]);
    require_once(__DIR__ . '/src/views/animal/show.php');
    echo "Animal avec ID {$matches[1]} chargé.<br>";
    exit;
} elseif ($url === 'animal/create') {
    $animalController = new AnimalController($db->getPdo());
    require_once(__DIR__ . '/src/views/animal/create.php');
    echo "Formulaire de création d'animal chargé.<br>";
    exit;
} elseif (preg_match('/^animal\/edit\/(\d+)$/', $url, $matches)) {
    $animalController = new AnimalController($db->getPdo());
    require_once(__DIR__ . '/src/views/animal/edit.php');
    echo "Formulaire d'édition pour l'animal ID {$matches[1]} chargé.<br>";
    exit;
} elseif (preg_match('/^animal\/delete\/(\d+)$/', $url, $matches)) {
    $animalController = new AnimalController($db->getPdo());
    $animalController->delete($matches[1]);
    echo "Animal avec ID {$matches[1]} supprimé.<br>";
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
