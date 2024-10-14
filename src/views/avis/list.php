<?php
require_once(__DIR__ . '/../config/env.php');
require_once(__DIR__ . '/../controllers/AvisController.php');

$db = new Database(); // Instancier la classe Database
$pdo = $db->getPdo(); // Obtenir l'instance PDO
$avisController = new AvisController($pdo); // Assurez-vous que $pdo est votre connexion à la base de données
$avisList = $avisController->list();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Avis</title>
  <link rel="stylesheet" href="<?php echo $baseUrl; ?>/styles.css">
</head>

<body>
  <?php require_once(__DIR__ . '/../header.php'); ?>

  <h2>Liste des Avis</h2>
  <table>
    <tr>
      <th>Pseudo</th>
      <th>Message</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($avisList as $avis) : ?>
      <tr>
        <td><?php echo htmlspecialchars($avis['pseudo']); ?></td>
        <td><?php echo htmlspecialchars($avis['message']); ?></td>
        <td><?php echo htmlspecialchars($avis['date_publication']); ?></td>
        <td>
          <a href="<?php echo $baseUrl; ?>/avis/update.php?id=<?php echo $avis['avis_id']; ?>">Modifier</a>
          <a href="<?php echo $baseUrl; ?>/avis/delete.php?id=<?php echo $avis['avis_id']; ?>">Supprimer</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <?php require_once(__DIR__ . '/../footer.php'); ?>
  <script src="<?php echo $baseUrl; ?>/script.js"></script>
</body>

</html>