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
    // Route pour la page d'accueil
    $serviceController = new ServiceController($db->getPdo()); // Passer la connexion PDO
    $serviceController->list(); // Appeler la méthode pour lister les services
} elseif ($url === 'services') {
    // Route pour la liste des services
    $serviceController = new ServiceController($db->getPdo()); // Passer la connexion PDO
    $serviceController->list(); // Appeler la méthode pour lister les services
} elseif ($url === 'habitats') {
    // Route pour la liste des habitats
    $habitatController = new HabitatController($db->getPdo()); // Passer la connexion PDO
    $habitatController->list();
} elseif (preg_match('/^habitat\/(\d+)$/', $url, $matches)) {
    // Route pour afficher un habitat spécifique
    $habitatController = new HabitatController($db->getPdo()); // Passer la connexion PDO
    $habitatController->show($matches[1]);
} elseif ($url === 'habitat/create') {
    // Route pour créer un nouvel habitat
    $habitatController = new HabitatController($db->getPdo()); // Passer la connexion PDO
    $habitatController->create();
} else {
    // Route non trouvée
    http_response_code(404);
    echo 'Page non trouvée';
}

// Routes pour les animaux
$animalController = new AnimalController($db->getPdo()); // Passer la connexion PDO

if (isset($_GET['controller']) && $_GET['controller'] === 'animal') {
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
}

// Créez votre connexion à la base de données
$db = new Database(); // Assurez-vous que la classe Database est correctement configurée
$avisController = new AvisController($db); // Initialisez le contrôleur des avis

// Définir la route par défaut
$action = $_GET['action'] ?? 'list'; // Si aucune action n'est fournie, on affiche la liste des avis

switch ($action) {
    case 'list':
        // Affichez la liste des avis
        require '/src/views/avis/list.php';
        break;

    case 'create':
        // Affichez le formulaire pour ajouter un nouvel avis
        require '/src/views/avis/create.php';
        break;

    case 'update':
        // Vérifiez que l'ID est fourni pour mettre à jour un avis
        if (isset($_GET['id'])) {
            require '/src/views/avis/update.php';
        } else {
            echo "ID de l'avis manquant pour la mise à jour.";
        }
        break;

    case 'delete':
        // Vérifiez que l'ID est fourni pour supprimer un avis
        if (isset($_GET['id'])) {
            require '/src/views/avis/delete.php';
        } else {
            echo "ID de l'avis manquant pour la suppression.";
        }
        break;

    default:
        // Si l'action n'est pas reconnue, afficher la liste des avis par défaut
        require '/src/views/avis/list.php';
        break;
}
