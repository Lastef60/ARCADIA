<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vétérinaire</title>
</head>
<body>
    <h1>Commentaires des Habitats</h1>
    <?php
    // Inclure les contrôleurs nécessaires
    require_once(__DIR__ . '/../controllers/HabitatController.php');
    require_once(__DIR__ . '/../controllers/RapportVeterinaireController.php');
    require_once(__DIR__ . '/../config/database.php');

    // Initialiser les contrôleurs
    $habitatController = new HabitatController();
    $habitats = $habitatController->list(); // Liste des habitats, la méthode renvoie les données et affiche la vue

    ?>

    <h1>Remplir un Rapport</h1>
    <form method="post" action="">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="detail">Détails:</label>
        <input type="text" id="detail" name="detail" required>

        <label for="animal_id">ID Animal:</label>
        <input type="number" id="animal_id" name="animal_id" required>

        <label for="etat_animal">État de l'Animal:</label>
        <textarea id="etat_animal" name="etat_animal" required></textarea>

        <label for="nourriture">Nourriture:</label>
        <input type="text" id="nourriture" name="nourriture" required>

        <label for="grammage">Grammage:</label>
        <input type="number" id="grammage" name="grammage" required>

        <button type="submit">Ajouter Rapport</button>
    </form>

    <?php
    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rapportController = new RapportVeterinaireController($pdo);
        $success = $rapportController->add($_POST);

        if ($success) {
            echo "<p>Rapport ajouté avec succès.</p>";
        } else {
            echo "<p>Erreur lors de l'ajout du rapport.</p>";
        }
    }
    ?>
</body>
</html>
