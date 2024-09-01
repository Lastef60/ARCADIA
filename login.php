<!-- lors du clic sur se connecter dans le menu, doit arriver sur cette page -->

<!-- faire formulaire de connexion-->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>connexion</title>
  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <!-- inclusion de l'entête du site -->
  <?php require_once(__DIR__ . '/header.php'); ?>

  <div class="css_login">
    <div class="css_login_content">
      <h2>Cette page est réservée aux employés du zoo.</h2>
      <h2>Cette page est réservée aux employés du zoo.</h2>
    </div>
  </div>

  <form class="css_form css_login_form" method="post" action="authentification.php"><!--mettre dans action nom du fichier qui recupère l'info de connexion-->
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="connexion"></input>
  </form>
  <!-- inclusion du footer du site -->
  <?php require_once(__DIR__ . '/footer.php'); ?>
  <script src="script.js"></script>
</body>

</html>