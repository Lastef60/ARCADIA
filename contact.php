<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avis</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>

<body>
  <!-- l'entête du site -->
  <?php require_once(__DIR__ . '/header.php'); ?>

  <h1 class="animate__animated animate__wobble">Donnez nous votre avis ...</h1>
  >Que pensez vous d'Arcadia ?</h1>

  <p class="css_contact_p">
    Vous êtes venus nous voir, dites nous ce que vous avez pensez de votre visite.
   <br> Vous pouvez également nous laissez vos suggestions.
    <br>A bientôt
  </p>

  <!-- Formulaire de contact -->
  <form class="css_form" method="post" action="traitement.php">
    <label for="pseudonyme">Votre pseudonyme:</label>
    <input type="text" id="pseudonyme" name="pseudonyme" required>

    <label for="message">Votre message :</label>
    <textarea id="message" name="message" rows="3" cols="40" required></textarea>

    <button type="submit">Envoyez</button>
  </form>

  <!-- inclusion du footer du site -->
  <?php require_once(__DIR__ . '/footer.php'); ?>
  <script src="script.js"></script>
</body>

</html>