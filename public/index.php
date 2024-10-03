<?php
require_once(__DIR__ . '/../core/functions.php');
$pdo = connexionBDD();

require_once(__DIR__ . '/../src/models/Service.php');
$serviceModel = new ServiceZoo($pdo);
$services = $serviceModel->getServices();

require_once(__DIR__ . '/../src/models/Horaire.php');
$horaireModel = new Horaire($pdo);
$horaires = $horaireModel->getHoraires();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php require_once(__DIR__ . '/../views/header.php'); ?>
    <h1>Bienvenue au Zoo Arcadia</h1>
    <div class="css_services_container">
        <?php foreach ($services as $service): ?>
            <h2><?= htmlspecialchars($service['nom'], ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endforeach; ?>
    </div>
    <div class="css_horaires_container">
        <h2>Horaires d'ouverture</h2>
        <ul>
            <?php foreach ($horaires as $horaire): ?>
                <li><?= htmlspecialchars($horaire['jour'], ENT_QUOTES, 'UTF-8') ?> : <?= htmlspecialchars($horaire['ouverture'], ENT_QUOTES, 'UTF-8') ?> - <?= htmlspecialchars($horaire['fermeture'], ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php require_once(__DIR__ . '/../views/footer.php'); ?>
    <script src="../public/script.js"></script>
</body>
</html>
