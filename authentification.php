<?php
// pour eviter que les erreurs s'affichent si pb de connexion
error_reporting(0);


require_once(__DIR__ . '/functions.php'); //y compris fonction pr se connecter à la BDD
require_once(__DIR__ . '/variables.php'); //y compris variables pr recup données du form
// se connecter à la base de donnée
$pdo = connexionBDD();

// Récupération des données du formulaire POST
$username = $_POST['username'];
$password = $_POST['password'];

// hash du mdp avec la methode SHA2 car methode utilisée dans mariadb
$hashedPassword = hash('sha256', $password);

//verification si nom existe et si password ok
$stmt = $pdo->prepare("
    SELECT r.label as role, u.password 
    FROM utilisateur u
    JOIN role r ON u.role_id = r.role_id
    WHERE username = :username
");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Debugg car pb connexion et eviter message erreur
if (!$user || $hashedPassword !== $user['password']) {
  echo "Nom d'utilisateur ou mot de passe incorrect";
  exit;
}

echo "Username from form: " . htmlspecialchars($username) . "<br>";
echo "Password from form: " . htmlspecialchars($password) . "<br>";
echo "Hashed password from form: " . $hashedPassword . "<br>";
echo "Hashed password from database: " . $user['password'] . "<br>";

//faire switch pour renvoyer vers les pages correspondantes aux roles
//si le mot de passa haché = mdp user
//exit pour arreter le csript apres direction
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
