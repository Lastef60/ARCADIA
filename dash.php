<?php
require_once(__DIR__ . '/functions.php');

// Connexion à MongoDB
$database = connexionArcadiaMongoBDD();

$collection = $database->selectCollection('animal');

// Récupérer tous les animaux et leurs consultations
$animals = $collection->find();
?>



<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Dashboard</title>
</head>

<body>
  <h1>Dashboard des Clics sur les Animaux</h1>
  <table class="css_table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Race</th>
        <th>Habitats</th>
        <th>Nombre de clics</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($animals as $animal): ?>
        <tr>
          <td><?php echo htmlspecialchars($animal['nom']); ?></td>
          <td><?php echo htmlspecialchars($animal['race']); ?></td>
          <td><?php echo htmlspecialchars($animal['habitat']); ?></td>
          <td><?php echo htmlspecialchars($animal['consultations']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>