<?php
// pour eviter que les erreurs s'affichent si pb de connexion
//error_reporting(0);

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/variables.php');

try {
    $pdo = connexionBDD();
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (empty($username) || empty($password)) {
    echo "Nom d'utilisateur ou mot de passe manquant.";
    exit;
}

$hashedPassword = hash('sha256', $password);

$stmt = $pdo->prepare("
    SELECT r.label as role, u.password 
    FROM utilisateur u
    JOIN role r ON u.role_id = r.role_id
    WHERE username = :username
");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$user || $hashedPassword !== $user['password']) {
    echo "Nom d'utilisateur ou mot de passe incorrect";
    exit;
}

echo "Username from form: " . htmlspecialchars($username) . "<br>";
echo "Password from form: " . htmlspecialchars($password) . "<br>";
echo "Hashed password from form: " . $hashedPassword . "<br>";
echo "Hashed password from database: " . $user['password'] . "<br>";

if ($hashedPassword === $user['password']) {
    echo "Les mots de passe correspondent.<br>";
    switch ($user['role']) {
        case 'admin':
            header('Location: administrateur.php');
            exit;
        case 'veterinaire':
            header('Location: veterinaire.php');
            exit;
        case 'employes':
            header('Location: employe.php');
            exit;
        default:
            echo "Vous n'êtes pas autorisé à vous connecter.";
            exit;
    }
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect";
    exit;
}
