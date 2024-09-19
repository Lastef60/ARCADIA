<?php

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/header.php');
$pdo = connexionBDD();

// Récupérer les services depuis la base de données
$services = $pdo->query("SELECT * FROM service")->fetchAll(PDO::FETCH_ASSOC);
// Pour récupérer les horaires depuis la base de données
$horaires = $pdo->query("SELECT * FROM horaire")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mettre à jour les horaires
    if (isset($_POST['update_horaires']) && isset($_POST['horaire'])) {
        foreach ($_POST['horaire'] as $id => $times) {
            $stmt = $pdo->prepare("UPDATE horaire SET ouverture = ?, fermeture = ? WHERE id = ?");
            $stmt->execute([$times['ouverture'], $times['fermeture'], $id]);
            echo 'Nouveaux horaires enregistrés';
        }
    }

    // Créer un nouveau service
    if (isset($_POST['create_service'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $stmt = $pdo->prepare("INSERT INTO service (nom, description) VALUES (?, ?)");
        $stmt->execute([$nom, $description]);
        echo 'Service créé';
    }

    // Mettre à jour les services
    if (isset($_POST['update_services']) && isset($_POST['service'])) {
        foreach ($_POST['service'] as $id => $description) {
            $stmt = $pdo->prepare("UPDATE service SET description = ? WHERE service_id = ?");
            $stmt->execute([$description, $id]);
            echo 'Service mis à jour';
        }
    }

    // Supprimer un service
    if (isset($_POST['delete_service'])) {
        $id = $_POST['delete_service'];
        $stmt = $pdo->prepare("DELETE FROM service WHERE service_id = ?");
        $stmt->execute([$id]);
        echo 'Service supprimé';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des services du Zoo</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Modifier les horaires</h2>
<form class="css_form" method="post">
  <?php foreach ($horaires as $horaire): ?>
    <div>
      <label for="ouverture_<?= $horaire['id'] ?>"><?= htmlspecialchars($horaire['jour'], ENT_QUOTES, 'UTF-8') ?> Ouverture:</label>
      <input type="time" id="ouverture_<?= $horaire['id'] ?>" name="horaire[<?= $horaire['id'] ?>][ouverture]" value="<?= htmlspecialchars($horaire['ouverture'], ENT_QUOTES, 'UTF-8') ?>">
      
      <label for="fermeture_<?= $horaire['id'] ?>">Fermeture:</label>
      <input type="time" id="fermeture_<?= $horaire['id'] ?>" name="horaire[<?= $horaire['id'] ?>][fermeture]" value="<?= htmlspecialchars($horaire['fermeture'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
  <?php endforeach; ?>
  <button type="submit" name="update_horaires">Enregistrer les modifications</button>
</form>

<h2>Modifier les Services</h2>
<form class="css_form" method="post">
  <?php foreach ($services as $service): ?>
    <div>
      <label><?= htmlspecialchars($service['nom'], ENT_QUOTES, 'UTF-8') ?>:</label>
      <textarea name="service[<?= $service['service_id'] ?>]"><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
      <button type="submit" name="delete_service" value="<?= $service['service_id'] ?>">Supprimer</button>
    </div>
  <?php endforeach; ?>
  <button type="submit" name="update_services">Enregistrer les modifications</button>
</form>

<h2>Ajouter un nouveau service</h2>
<form class="css_form" method="post">
  <div>
    <label>Nom du service :</label>
    <input type="text" name="nom" required>
  </div>
  <div>
    <label>Description :</label>
    <textarea name="description" required></textarea>
  </div>
  <button type="submit" name="create_service">Créer le service</button>
</form>

<script src="script.js"></script>
</body>
</html>
