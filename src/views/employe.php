<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Employé</title>
</head>
<body>
    <?php
    require_once(__DIR__ . '/../controllers/HabitatController.php');
    require_once(__DIR__ . '/../config/database.php');

    $controller = new HabitatController();

    // Récupération des habitats pour affichage
    $habitats = $controller->list();

    foreach ($habitats as $habitat) {
        echo "<h3>{$habitat['nom']}</h3>";
        echo "<p>Description: {$habitat['description']}</p>";
        echo "<p>Commentaire actuel: {$habitat['commentaire_habitat']}</p>";

        // Formulaire pour mettre à jour le commentaire
        echo "
            <form method='post' action='/employe.php'>
                <input type='hidden' name='habitat_id' value='{$habitat['habitat_id']}'>
                <label for='commentaire'>Nouveau commentaire:</label>
                <textarea name='commentaire_habitat' id='commentaire' rows='4' cols='50'></textarea>
                <button type='submit'>Mettre à jour le commentaire</button>
            </form>
            <hr>
        ";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->updateComment();
    }
    ?>
</body>
</html>
