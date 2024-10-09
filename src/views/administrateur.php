<?php
require_once(__DIR__ . '/controllers/AnimalController.php');
require_once(__DIR__ . '/controllers/ServiceController.php');
require_once(__DIR__ . '/controllers/HoraireController.php');
require_once(__DIR__ . '/controllers/HabitatController.php');
require_once(__DIR__ . '/controllers/UtilisateurController.php');
require_once(__DIR__ . '/controllers/RapportVeterinaireController.php');
require_once(__DIR__ . '/controllers/DashboardController.php');


$pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

$dashboardController = new DashboardController($couchDB, $pdo);

$animalController = new AnimalController($pdo);
$rapportController = new RapportVeterinaireController($pdo);
$serviceController = new ServiceController($pdo);
$horaireController = new HoraireController($pdo); 
$habitatController = new HabitatController($pdo); 
$utilisateurController = new UtilisateurController($pdo); 


// Obtenir la liste des animaux pour le formulaire des rapports
$animaux = $animalController->list($habitat_id); // Assurez-vous que $habitat_id est défini

// Vérification du formulaire des rapports vétérinaires
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['animal_id'])) {
    $animalId = $_POST['animal_id'];
    $rapports = $rapportController->list(); // Utilisez la méthode list pour obtenir tous les rapports
}
//recuperer les rapports vétérinaires
$rapports = [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['animal_id'])) {
    $animalId = $_POST['animal_id'];
    $rapports = $rapportController->list(); // Assurez-vous que ça retourne les rapports
}

// Obtenir les données du dashboard CouchDB
$clickData = $dashboardController->getClickData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
</head>
<body>
    <h1>Bienvenue, Administrateur</h1>
    <p>Veuillez sélectionner votre tâche :</p>

    <!-- Section pour consulter les rapports vétérinaires -->
    <h2>Consulter les rapports vétérinaires</h2>
    <form method="POST" action="">
        <label for="animal_id">Sélectionner un animal :</label>
        <select id="animal_id" name="animal_id" required>
            <option value="">--Sélectionner un animal--</option>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= htmlspecialchars($animal['animal_id']) ?>">
                    <?= htmlspecialchars($animal['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Rechercher">
    </form>

    <?php if (isset($rapports)): ?>
        <h2>Rapports pour l'animal sélectionné</h2>
        <?php if (count($rapports) > 0): ?>
            <table border="1">
                <tr>
                    <th>Date</th>
                    <th>Détail</th>
                    <th>État de l'animal</th>
                    <th>Nourriture</th>
                    <th>Grammage</th>
                </tr>
                <?php foreach ($rapports as $rapport): ?>
                    <tr>
                        <td><?= htmlspecialchars($rapport['date']) ?></td>
                        <td><?= htmlspecialchars($rapport['detail']) ?></td>
                        <td><?= htmlspecialchars($rapport['etat_animal']) ?></td>
                        <td><?= htmlspecialchars($rapport['nourriture']) ?></td>
                        <td><?= htmlspecialchars($rapport['grammage']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Aucun rapport trouvé pour cet animal.</p>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Sections pour gérer les services, horaires, habitats, utilisateurs, et animaux -->
    <h2>Gérer les services</h2>
    <p><a href="gestion_services.php">Accéder à la gestion des services</a></p>
    
    <h2>Gérer les horaires</h2>
    <p><a href="gestion_horaires.php">Accéder à la gestion des horaires</a></p>
    
    <h2>Gérer les habitats</h2>
    <p><a href="gestion_habitats.php">Accéder à la gestion des habitats</a></p>
    
    <h2>Gérer les utilisateurs</h2>
    <p><a href="gestion_utilisateurs.php">Accéder à la gestion des utilisateurs</a></p>
    
    <h2>Gérer les animaux</h2>
    <p><a href="gestion_animaux.php">Accéder à la gestion des animaux</a></p>

    <!-- Section Dashboard CouchDB -->
    <h2>Dashboard des clics sur les animaux</h2>
    <p>Nombre total de clics : <?= htmlspecialchars($clickData['total_clicks']) ?></p>
    <table border="1">
        <tr>
            <th>Animal</th>
            <th>Nombre de clics</th>
        </tr>
        <?php foreach ($clickData['details'] as $animalName => $clickCount): ?>
            <tr>
                <td><?= htmlspecialchars($animalName) ?></td>
                <td><?= htmlspecialchars($clickCount) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
