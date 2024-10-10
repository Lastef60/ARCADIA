<?php 
require_once(__DIR__ . '/../../config/env.php');
require_once (__DIR__.'../src/models/Database.php'); // Inclure le modèle de base de données

$db = new Database(); // Instancier la classe Database
$pdo = $db->getPdo(); // Obtenir l'instance PDO pour MariaDB

require_once(__DIR__.'/../controllers/ServiceController.php'); // Inclure le contrôleur
$controller = new ServiceController($pdo); // Instancier le contrôleur
$services = $controller->list(); // Appeler la méthode pour lister les services et récupérer les données
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nos services</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php require_once(__DIR__.'/header.php'); ?>

  <?php if (!empty($services)): ?>
    <?php foreach ($services as $service): ?>
      <h2><?php echo htmlspecialchars($service['nom']); ?></h2>
      <p><?php echo htmlspecialchars($service['description']); ?></p>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucun service disponible.</p>
  <?php endif; ?>

  <img class="css_img" src="./uploads/img/service_petitTrain.jpg" />
  <p>Découvrez le zoo de manière ludique et confortable grâce à notre petit train!</p>

  <img class="css_img" src="./uploads/img/service_visiteGuidee.jpg" />
  <p>Vivez une expérience unique et éducative en participant à notre visite guidée gratuite.</p>

  <img class="css_img" src="./uploads/img/service_resto2.jpg" />
  <p>Faites une pause gourmande lors de votre visite au zoo en vous arrêtant dans l'un de nos restaurants.</p>
</body>
</html>
