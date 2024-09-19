<?php
require_once(__DIR__ . '/functions.php');
$pdo = connexionBDD();

// Récupérer les services depuis la base de données
$services = $pdo->query("SELECT * FROM service")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les horaires depuis la base de données
$horaires = $pdo->query("SELECT * FROM horaire")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nos services</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php require_once(__DIR__ . '/header.php'); ?>

  <div class="css_services_container">
    <!-- Service Petit Train -->
    <div class="css_service">
      <img class="css_services_img train" src="./uploads/img/service_petitTrain.jpg" alt="photo d'un petit train" />
      <p class="css_services_p">
        Découvrez le zoo de manière ludique et confortable grâce à notre petit train!
        Ce service unique vous permet de faire le tour complet du parc sans effort tout en profitant
        de commentaires éducatifs sur les différentes espèces et leurs habitats.
        Idéal pour les familles avec enfants, les personnes âgées ou simplement pour ceux qui souhaitent se détendre,
        le petit train offre une vue panoramique exceptionnelle sur l'ensemble du zoo.
        Embarquez et laissez-vous guider à travers les merveilles du monde animal!
        RDV à l'accueil du zoo pour un départ toutes les heures.
      </p>
    </div>

    <!-- Service Visite Guidée -->
    <div class="css_service">
      <img class="css_services_img guide" src="./uploads/img/service_visiteGuidee.jpg" alt="photo d'un soigneur"/>
      <p class="css_services_p guide">
        Vivez une expérience unique et éducative en participant à notre visite guidée gratuite,
        animée par un soigneur passionné. Notre zoo abrite trois habitats distincts,
        chacun recréant fidèlement les environnements naturels des animaux qui y résident.
        Lors de cette visite, vous découvrirez l'habitat des savanes, des forêts tropicales et des zones humides.
        Le soigneur vous fournira des informations fascinantes sur les comportements, les adaptations et
        les besoins spécifiques de chaque espèce, tout en partageant des anecdotes captivantes.
        Cette visite guidée est une occasion idéale pour approfondir vos connaissances et apprécier la biodiversité de notre planète.
        N'hésitez pas à poser toutes vos questions.
        Uniquement sur réservation auprès de l'accueil.
      </p>
    </div>

    <!-- Service Restaurant -->
    <div class="css_service">
      <img class="css_services_img resto" src="./uploads/img/service_resto2.jpg" alt="photo d'un restaurant" />
      <p class="css_services_p">
        Faites une pause gourmande lors de votre visite au zoo en vous arrêtant dans l'un de nos restaurants.
        Nous proposons une variété de cuisines pour satisfaire tous les goûts, allant des plats traditionnels aux options végétariennes et véganes.
        Chaque restaurant est stratégiquement situé pour offrir une vue imprenable sur les enclos des animaux,
        transformant votre repas en une expérience immersive.
        Nos chefs mettent un point d'honneur à utiliser des ingrédients frais et locaux pour vous garantir une alimentation saine et savoureuse.
        Profitez d'un moment de détente et de plaisir culinaire au cœur de la nature!
      </p>
    </div>
  </div>

  <h2>Horaires du Zoo</h2>
  <div class="css_horaires_container">
    <?php foreach ($horaires as $horaire): ?>
      <div class="css_horaire">
        <p><strong><?= htmlspecialchars($horaire['jour'], ENT_QUOTES, 'UTF-8') ?> :</strong></p>
        <p>Ouverture: <?= htmlspecialchars($horaire['ouverture'], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Fermeture: <?= htmlspecialchars($horaire['fermeture'], ENT_QUOTES, 'UTF-8') ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

</html>
