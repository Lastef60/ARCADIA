<?php
require_once(__DIR__ . '/../core/functions.php');
require_once(__DIR__.'../../src/models/Database.php');

// Code pour récupérer et afficher les habitats
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitats</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <?php require_once(__DIR__ . '/../src/views/header.php'); ?>
    <h1>Habitats du Zoo</h1>
    <!-- Code pour afficher les habitats -->
    <?php require_once(__DIR__ . '/../views/footer.php'); ?>
    <script src="../public/script.js"></script>
</body>
</html>
