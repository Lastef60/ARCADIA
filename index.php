<?php

// Charger les fichiers nécessaires
require_once(__DIR__ . '/config/env.php');
echo "Fichier env.php chargé.<br>";
require_once(__DIR__ . '/src/models/Database.php'); // Ajouter la classe Database ici
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
$db = new Database(); // Instanciation de Database
echo "Instance de Database créée.<br>";

// Récupérer l'URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
echo "URL récupérée: $url<br>";

// Définir les routes pour les services et les habitats
if ($url === '') {
    $serviceController = new ServiceController($db->getPdo()); // Passer la connexion PDO
    $serviceController->list(); // Appeler la méthode pour lister les services
    echo "Page d'accueil des services chargée.<br>";
    exit;
} elseif ($url === 'services') {
    $serviceController = new ServiceController($db->getPdo());
    $serviceController->list();
    echo "Liste des services chargée.<br>";
    exit;
} elseif ($url === 'habitats') {
    $habitatController = new HabitatController($db->getPdo());
    $habitatController->list();
    echo "Liste des habitats chargée.<br>";
    exit;
} elseif (preg_match('/^habitat\/(\d+)$/', $url, $matches)) {
    $habitatController = new HabitatController($db->getPdo());
    $habitatController->show($matches[1]);
    echo "Habitat avec ID {$matches[1]} chargé.<br>";
    exit;
} elseif ($url === 'habitat/create') {
    $habitatController = new HabitatController($db->getPdo());
    $habitatController->create();
    echo "Formulaire de création d'habitat chargé.<br>";
    exit;
}

// Routes pour les animaux
$animalController = new AnimalController($db->getPdo());
echo "AnimalController initialisé.<br>";

if (isset($_GET['controller']) && $_GET['controller'] === 'animal') {
    switch ($_GET['action']) {
        case 'list':
            $animalController->list($_GET['habitat_id']);
            echo "Liste des animaux pour l'habitat ID {$_GET['habitat_id']} chargée.<br>";
            exit;
        case 'show':
            $animalController->show($_GET['id']);
            echo "Détails de l'animal avec ID {$_GET['id']} chargés.<br>";
            exit;
        case 'create':
            $animalController->create();
            echo "Formulaire de création d'animal chargé.<br>";
            exit;
        case 'edit':
            $animalController->edit($_GET['id']);
            echo "Formulaire d'édition pour l'animal ID {$_GET['id']} chargé.<br>";
            exit;
        case 'delete':
            $animalController->delete($_GET['id']);
            echo "Animal avec ID {$_GET['id']} supprimé.<br>";
            exit;
        default:
            http_response_code(404);
            echo 'Action non trouvée.<br>';
            exit;
    }
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
