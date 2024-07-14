<!-- faire formulaire de contact -->
<!DOCTYPE html>
<html lang="fr">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 </head>
 <body>
   <!-- inclusion de l'entête du site -->
   <?php require_once(__DIR__.'/header.php'); ?>
   <form method="post" action=""><!--mettre dans action nom du fichier qui recupère l'info de connexion-->
    <label for="pseudonym">Votre pseudonyme:</label>
    <input type="text" id="pseudonym" name="pseudonym" required>
    <label for="message"> indiquez nous votre message ou demande : </label>
    <input type="area" id="message" name="message" required>
    <button type="submit">Connexion</button>
</form>
   <!-- inclusion du footer du site -->
    <?php require_once(__DIR__.'/footer.php'); ?>
 </body>
 </html>