<?php
require_once(__DIR__ . '/functions.php');

// Vérification si le nom d'utilisateur a été envoyé via POST
$username = isset($_POST['username']) ? $_POST['username'] : null;

if (empty($username)) {
    die('Erreur : Le nom d\'utilisateur doit être fourni pour supprimer un utilisateur.');
}

// Appel de la fonction pour supprimer un utilisateur
try {
    supprimerUtilisateur($username);
    echo "Utilisateur supprimé avec succès.";
} catch (Exception $exception) {
    echo "Erreur lors de la suppression de l'utilisateur : " . $exception->getMessage();
}


