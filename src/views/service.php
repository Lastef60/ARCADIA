<?php
require_once(__DIR__ . '/../../config/env.php');
require_once(__DIR__ . '/../models/Database.php'); // Inclure le modèle de base de données

$db = new Database(); // Instancier la classe Database
$pdo = $db->getPdo(); // Obtenir l'instance PDO pour MariaDB

require_once(__DIR__ . '/../controllers/ServiceController.php'); // Inclure le contrôleur
$controller = new ServiceController($pdo); // Instancier le contrôleur
$services = $controller->list(); // Appeler la méthode pour lister les services et récupérer les données
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nos services</title>
  <link rel="stylesheet" href="../../public/styles.css">
</head>

<body>
  <?php require_once(__DIR__ . '/header.php'); ?>

  <h1>Nos services</h1>

  <?php if (!empty($services)): ?>
    <?php foreach ($services as $service): ?>
      <h2><?php echo htmlspecialchars($service['nom']); ?></h2>
      <p><?php echo htmlspecialchars($service['description']); ?></p>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucun service disponible.</p>
  <?php endif; ?>

  <div class="service-container">
    <img class="css_img" src="../../public/uploads/img/service_petitTrain.jpg" alt="Petit Train" />
    <p>Découvrez le zoo de manière ludique et confortable grâce à notre petit train!
      Ce service unique vous permet de faire le tour complet du parc sans effort tout en profitant
      de commentaires éducatifs sur les différentes espèces et leurs habitats. Idéal pour les familles
      avec enfants, les personnes âgées ou simplement pour ceux qui souhaitent se détendre, le petit
      train offre une vue panoramique exceptionnelle sur l'ensemble du zoo. Embarquez et laissez-vous guider à travers les merveilles du monde animal!
      RDV à l'accueil du zoo pour un départ toutes les heures.</p>
  </div>

  <div class="service-container">
    <img class="css_img" src="../../public/uploads/img/service_visiteGuidee.jpg" alt="Visite Guidée" />
    <p>Vivez une expérience unique et éducative en participant à notre visite guidée gratuite, animée par un soigneur passionné.
      Notre zoo abrite trois habitats distincts, chacun recréant fidèlement les environnements naturels des animaux qui y résident.
      Lors de cette visite, vous découvrirez l'habitat des savanes, des forêts tropicales et des zones humides.
      Le soigneur vous fournira des informations fascinantes sur les comportements, les adaptations et les besoins spécifiques de chaque espèce,
      tout en partageant des anecdotes captivantes. Cette visite guidée est une occasion idéale pour approfondir vos connaissances et apprécier la biodiversité de notre planète. 
      N'hésitez pas à poser toutes vos questions. Uniquement sur réservation auprès de l'accueil.</p>
  </div>

  <div class="service-container">
    <img class="css_img" src="../../public/uploads/img/service_resto2.jpg" alt="Restaurant" />
    <p>Faites une pause gourmande lors de votre visite au zoo en vous arrêtant dans l'un de nos restaurants. 
      Nous proposons une variété de cuisines pour satisfaire tous les goûts, allant des plats traditionnels 
      aux options végétariennes et véganes. Chaque restaurant est stratégiquement situé pour offrir 
      une vue imprenable sur les enclos des animaux, transformant votre repas en une expérience immersive. 
      Nos chefs mettent un point d'honneur à utiliser des ingrédients frais et locaux pour vous garantir 
      une alimentation saine et savoureuse. Profitez d'un moment de détente et de plaisir culinaire au cœur de la nature!</p>
  </div>

  <h2>Horaires</h2>
    <?php if (!empty($horaires)): ?>
        <?php foreach ($horaires as $horaire): ?>
            <p><?php echo htmlspecialchars($horaire['jour']) . ': ' . htmlspecialchars($horaire['ouverture']) . ' - ' . htmlspecialchars($horaire['fermeture']); ?></p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun horaire disponible.</p>
    <?php endif; ?>

    <?php require_once(__DIR__ . '/footer.php'); ?>

</body>

</html>
