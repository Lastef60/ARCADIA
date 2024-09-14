<?php
require_once(__DIR__ . '/functions.php'); // Inclure ta fonction de connexion à la BDD

// Connexion à la base de données
$pdo = connexionBDD();

// Sélectionne tous les utilisateurs et hache les mdp
$stmt = $pdo->query("SELECT id, password FROM utilisateur");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    // Hacher le mot de passe existant avec SHA-256
    $updateStmt = $pdo->prepare("UPDATE utilisateur SET password = SHA2(password, 256) WHERE id = :id");
    $updateStmt->execute(['id' => $user['id']]);
}

echo "Tous les mots de passe ont été hachés avec SHA-256.";
?>
