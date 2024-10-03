<?php
require_once(__DIR__ . '/../core/variables.php'); 
require_once(__DIR__ . '/../src/classes/Database.php');
require_once(__DIR__ . '/../src/classes/Avis.php');

// Connexion à la base de données
$database = new Database();
$pdo = $database->getConnection();

header('Content-Type: application/json');

// Initialisation des variables pour les messages
$messageErreur = '';
$messageSucces = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudonyme'] ?? null;
    $message = $_POST['message'] ?? null;

    // Vérifie que les champs ne sont pas vides
    if (!empty($pseudo) && !empty($message)) {
        // Préparer et exécuter l'insertion dans la table temporaire
        $stmt = $pdo->prepare("INSERT INTO avis_temp (pseudo, message, isvisible) VALUES (?, ?, 0)");
        $success = $stmt->execute([$pseudo, $message]);

        // Vérifier si l'insertion a réussi
        if ($success) {
            $messageSucces = "Nous avons reçu votre message. Merci pour votre avis !";
        } else {
            $messageErreur = "Une erreur s'est produite lors de la soumission de votre avis.";
        }
    } else {
        $messageErreur = "Veuillez compléter tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Traitement des avis</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
  <?php require_once(__DIR__ . '/../views/header.php'); ?>

  <?php if (!empty($messageSucces)): ?>
      <h1>Avis bien transmis</h1>
      <p><?php echo htmlspecialchars($messageSucces); ?></p>
  <?php else: ?>
      <h1>Une erreur s'est produite</h1>
      <p><?php echo htmlspecialchars($messageErreur); ?></p>
  <?php endif; ?>

  <?php require_once(__DIR__ . '/../views/footer.php'); ?>
  <script src="../public/script.js"></script>
</body>
</html>
