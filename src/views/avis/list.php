<?php
require_once 'controllers/AvisController.php';

$avisController = new AvisController($db); // Assurez-vous que $db est votre connexion à la base de données
$avisList = $avisController->list();
?>

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
                <a href="update.php?id=<?php echo $avis['avis_id']; ?>">Modifier</a>
                <a href="delete.php?id=<?php echo $avis['avis_id']; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
