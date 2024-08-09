<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avis</title>
  <link rel="stylesheet" href="styles.css">

</head>
<body>
  <!-- l'entête du site -->
  <?php require_once(__DIR__.'/header.php'); ?>

  <!-- Formulaire de contact -->
  <form  method="post" action="traitement.php">
    <label for="pseudonyme">Votre pseudonyme:</label>
    <input type="text" id="pseudonyme" name="pseudonyme" required>
    
    <label for="message">Donnez-nous votre avis :</label>
    <textarea id="message" name="message" rows="3" cols="40" required></textarea>
    
    <button type="submit">Envoyez</button>
  </form>

  <!-- inclusion du footer du site -->
  <?php require_once(__DIR__.'/footer.php'); ?>
  <script src="script.js"></script>
</body>
</html>