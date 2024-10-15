<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <?php require_once(__DIR__ . '/../views/header.php'); ?> 
    <div class="css_login">
        <h2>Cette page est réservée aux employés du zoo.</h2>
        <form class="css_form css_login_form" method="post" action="../src/controllers/authentification.php"> 
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Connexion">
        </form>
    </div>
    <?php require_once(__DIR__ . '/../views/footer.php'); ?> 
    <script src="../public/script.js"></script> 
</body>
</html>
