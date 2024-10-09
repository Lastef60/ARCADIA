<?php
require_once 'controllers/AvisController.php';

$avisController = new AvisController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $message = $_POST['message'];
    $avisController->create($pseudo, $message);
    header('Location: list.php');
}

?>

<h2>Ajouter un Avis</h2>
<form method="POST">
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" required>
    <label for="message">Message:</label>
    <textarea name="message" required></textarea>
    <button type="submit">Envoyer</button>
</form>
