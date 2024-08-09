<?php
require_once(__DIR__.'/functions.php');

$pdo = connexionBDD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $avis_id = $_POST['avis_id'];
  $action = $_POST['action'];

  if ($action == 'valider') {
    // Mise à jour de isvisible à 1 pour valider l'avis
    $stmt = $pdo->prepare("UPDATE avis SET isvisible = 1 WHERE avis_id = ?");
    $stmt->execute([$avis_id]);
  } elseif ($action == 'supprimer') {
    // Suppression de l'avis de la base de données
    $stmt = $pdo->prepare("DELETE FROM avis WHERE avis_id = ?");
    $stmt->execute([$avis_id]);
  }
}

exit;
?>
