<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Utiliser un fichier de log pour les erreurs
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error_log.txt'); // Chemin du fichier de log

require_once(__DIR__ . '/../core/variables.php');
require_once(__DIR__ . '/../core/AuthentificationService.php'); // Charger la classe d'authentification
require_once(__DIR__ . '/../core/Database.php'); // Charger la classe de base de données

try {
    $database = new Database(); // Créer une instance de la classe Database
    $pdo = $database->getConnection(); // Obtenir la connexion PDO
    $authService = new AuthentificationService($pdo); // Créer une instance de la classe d'authentification
} catch (PDOException $e) {
    error_log("Erreur de connexion : " . $e->getMessage());
    die("Erreur de connexion, veuillez réessayer plus tard.");
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

try {
    $role = $authService->authenticate($username, $password); // Authentifier l'utilisateur

    // Redirection en fonction du rôle
    switch ($role) {
        case 'admin':
            header('Location: ../src/controllers/administrateur.php'); 
            exit;
        case 'veterinaire':
            header('Location: ../src/controllers/veterinaire.php'); 
            exit;
        case 'employes':
            header('Location: ../src/controllers/employe.php'); 
            exit;
        default:
            echo "Vous n'êtes pas autorisé à vous connecter.";
            exit;
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
