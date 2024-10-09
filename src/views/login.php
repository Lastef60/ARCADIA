<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once(__DIR__ . '/../controllers/UtilisateurController.php');
        require_once(__DIR__ . '/../config/database.php'); // Fichier qui crée la connexion PDO

        $controller = new UtilisateurController($pdo);
        $message = $controller->login($_POST['email'], $_POST['password']);

        if ($message) {
            echo "<p>$message</p>";
        }
    }
    ?>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Connexion</button>
    </form>
</body>
</html>
