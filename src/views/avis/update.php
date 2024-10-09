<?php
require_once 'controllers/AvisController.php';

$avisController = new AvisController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $message = $_POST['message'];
    $avisController->update($id, $pseudo, $message);
    header('Location: list.php');
}

$id = $_GET['id'];
$avis = $avisController->show($id);
?>

<h2>Modifier l'Avis</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $avis['avis_id']; ?>">
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" value="<?php echo htmlspecialchars($avis['pseudo']); ?>" required>
    <label for="message">Message:</label>
    <textarea name="message" required><?php echo htmlspecialchars($avis['message']); ?></textarea>
    <button type="submit">Mettre à jour</button>
</form>
