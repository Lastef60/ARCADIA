<?php


require_once(__DIR__ . '/functions.php');

$pdo = connexionBDD();

header('Content-Type: application/json'); // Assurez-vous que le type de contenu est JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pseudo = $_POST['pseudonyme'];
  $message = $_POST['message'];

  // Préparer et exécuter l'insertion dans la table temporaire
  $stmt = $pdo->prepare("INSERT INTO avis_temp (pseudo, message, isvisible) VALUES (?, ?, 0)");
  $success = $stmt->execute([$pseudo, $message]);

  // Vérifier si l'insertion a réussi
  if ($success) {
    // Redirection vers la page de succès
    header('Location: succesAvis.php');
  } else {
    // Redirection vers la page d'erreur
    header('Location: erreurAvis.php');
  }
  exit();
}
