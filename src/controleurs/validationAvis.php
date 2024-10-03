<?php
require_once(__DIR__ . '/../core/variables.php');
require_once(__DIR__ . '/../src/classes/Database.php');
require_once(__DIR__ . '/../src/classes/Avis.php');

// Connexion à la base de données
$database = new Database();
$pdo = $database->getConnection();

// Création de l'objet Avis
$avis = new Avis($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avis_id = $_POST['avis_id'];
    $action = $_POST['action'];

    if ($action === 'valider') {
        // Appel de la méthode validerAvis
        $success = $avis->validerAvis($avis_id);
        if ($success) {
            // Redirection ou message de succès
            echo json_encode(['status' => 'success', 'message' => 'Avis validé avec succès.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la validation de l\'avis.']);
        }
    } elseif ($action === 'supprimer') {
        // Appel de la méthode supprimerAvis
        $success = $avis->supprimerAvis($avis_id);
        if ($success) {
            // Redirection ou message de succès
            echo json_encode(['status' => 'success', 'message' => 'Avis supprimé avec succès.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la suppression de l\'avis.']);
        }
    }
}

exit;


