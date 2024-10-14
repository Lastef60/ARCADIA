<?php
session_start(); // Démarrer une session pour gérer les redirections

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once(__DIR__ . '/../../config/env.php'); // Inclure le fichier de connexion à la base de données
    require_once(__DIR__ . '/../controllers/UtilisateurController.php'); // Inclure le contrôleur

    $db = new Database(); // Instancier la classe Database
    $pdo = $db->getPdo(); // Obtenir l'instance PDO
    $controller = new UtilisateurController($pdo); // Instancier le contrôleur
    $user = $controller->login($_POST['email'], $_POST['password']); // Tenter de connecter l'utilisateur

    if ($user) {
        // Redirection en fonction du rôle de l'utilisateur
        if ($user['role'] === 'administrateur') {
            header('Location: administrateur.php');
            exit;
        } elseif ($user['role'] === 'employe') {
            header('Location: employe.php');
            exit;
        } elseif ($user['role'] === 'veterinaire') {
            header('Location: veterinaire.php');
            exit;
        }
    } else {
        echo "<p>Connexion échouée. Vérifiez vos identifiants.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/css/styles.css"> 
</head>
<body>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Connexion</button>
    </form>

    <?php require_once(__DIR__ . '/../../footer.php'); ?> 
    <script src="../../public/js/script.js"></script> 
</body>
</html>
