<?php
require_once(__DIR__ . '/../core/functions.php');
require_once(__DIR__ . '/../classes/Utilisateur.php');
require_once(__DIR__ . '/../classes/Database.php'); // Inclusion de la classe Database

$database = new Database();
$pdo = $database->getConnection();  // Récupération de la connexion PDO via la classe Database

$utilisateur = new Utilisateur($pdo);

$message = '';  // Pour afficher les messages de succès ou d'erreur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    // Gestion de l'ajout d'utilisateur
    if ($action === 'ajouter') {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $role_id = $_POST['role_id'] ?? null;

        try {
            $utilisateur->ajouter($username, $password, $nom, $prenom, $role_id);
            $message = "Utilisateur ajouté avec succès.";
        } catch (Exception $e) {
            $message = "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    }

    // Gestion de la suppression d'utilisateur
    elseif ($action === 'supprimer') {
        $username = $_POST['username'] ?? null;

        try {
            $utilisateur->supprimer($username);
            $message = "Utilisateur supprimé avec succès.";
        } catch (Exception $e) {
            $message = "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des utilisateurs</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>

<body>

  <!-- Affichage des messages de succès ou d'erreur -->
  <?php if (!empty($message)) : ?>
    <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
  <?php endif; ?>

  <h2>Création compte utilisateur</h2>
  <p>Afin de créer un compte utilisateur à un nouvel employé, merci de compléter le formulaire suivant.</p>

  <form class="css_form" method="post" action="">
    <input type="hidden" name="action" value="ajouter">
    
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <label for="nom">NOM:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required>

    <fieldset>
      <legend>Rôle</legend>
      <label for="veterinaire">
        <input type="radio" id="veterinaire" name="role_id" value="2" required>
        Vétérinaire</label>
      <label for="employe">
        <input type="radio" id="employe" name="role_id" value="3" required>
        Employé</label>
    </fieldset>

    <input type="submit" value="Enregistrer">
  </form>

  <h2>Suppression compte utilisateur</h2>

  <form class="css_form" method="post" action="">
    <input type="hidden" name="action" value="supprimer">
    
    <label for="username">Nom d'utilisateur à supprimer:</label>
    <input id="username" name="username" required>

    <input type="submit" value="Supprimer">
  </form>

</body>

</html>
