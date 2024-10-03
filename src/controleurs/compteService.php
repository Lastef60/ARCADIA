<?php

require_once(__DIR__ . '/../core/Database.php'); // Inclure la classe Database
require_once(__DIR__ . '/../core/ServiceZoo.php'); // Inclure la classe ServiceZoo
require_once(__DIR__ . '/../core/Horaire.php'); // Inclure la classe Horaire

$database = new Database(); // Créer une instance de la classe Database
$pdo = $database->getPDO(); // Obtenir la connexion PDO

// Créer les instances des classes Horaire et ServiceZoo
$horaire = new Horaire($pdo);
$service = new ServiceZoo($pdo);

$services = $service->getServices(); // Récupérer les services depuis la BDD
$horaires = $horaire->getHoraires(); // Récupérer les horaires depuis la BDD

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mettre à jour les horaires
    if (isset($_POST['update_horaires']) && isset($_POST['horaire'])) {
        foreach ($_POST['horaire'] as $id => $times) {
            if (isset($times['ouverture']) && isset($times['fermeture'])) {
                $horaire->updateHoraire($id, $times['ouverture'], $times['fermeture']);
            }
        }
        $successMessage = 'Nouveaux horaires enregistrés';
    }

    // Créer un nouveau service
    if (isset($_POST['create_service'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $service->createService($nom, $description);
        $successMessage = 'Service créé';
    }

    // Mettre à jour les services
    if (isset($_POST['update_services'])) {
        foreach ($_POST['service'] as $id => $description) {
            $service->updateService($id, $description);
        }
        $successMessage = 'Services mis à jour';
    }

    // Supprimer un service
    if (isset($_POST['delete_service'])) {
        $id = $_POST['delete_service'];
        $service->deleteService($id);
        $successMessage = 'Service supprimé';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des services du Zoo</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>

<?php if ($successMessage): ?>
    <p><?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

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
            <label for="service_<?= $service['service_id'] ?>"><?= htmlspecialchars($service['nom'], ENT_QUOTES, 'UTF-8') ?>:</label>
            <textarea id="service_<?= $service['service_id'] ?>" name="service[<?= $service['service_id'] ?>]"><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
            <button type="submit" name="delete_service" value="<?= $service['service_id'] ?>">Supprimer</button>
        </div>
    <?php endforeach; ?>
    <button type="submit" name="update_services">Enregistrer les modifications</button>
</form>

<h2>Ajouter un nouveau service</h2>
<form class="css_form" method="post">
    <div>
        <label for="nom_service">Nom du service :</label>
        <input type="text" id="nom_service" name="nom" required>
    </div>
    <div>
        <label for="description_service">Description :</label>
        <textarea id="description_service" name="description" required></textarea>
    </div>
    <button type="submit" name="create_service">Créer le service</button>
</form>
<script src="../public/script.js"></script>
</body>
</html>
