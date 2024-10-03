<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Partagez votre expérience avec nous ! Laissez un avis sur votre visite au Zoo Arcadia.">
    <title>Avis</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php require_once(__DIR__ . '/../views/header.php'); ?>
    <h1>Donnez nous votre avis ...</h1>
    <p>Vous êtes venus nous voir, dites nous ce que vous avez pensé de votre visite.</p>
    <form class="css_form" method="post" action="traitement.php">
        <label for="pseudonyme">Votre pseudonyme:</label>
        <input type="text" id="pseudonyme" name="pseudonyme" required>
        <label for="message">Votre message :</label>
        <textarea id="message" name="message" rows="3" cols="40" required></textarea>
        <button type="submit">Envoyez</button>
    </form>
    <?php require_once(__DIR__ . '/../views/footer.php'); ?>
    <script src="../public/script.js"></script>
</body>
</html>
