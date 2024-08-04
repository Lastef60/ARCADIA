<?php

require_once(__DIR__.'/functions.php');

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // recup donnee form
  $nom_habitat = $_POST['name']; 
  $description = $_POST['description'];
  $commentaire_habitat = $_POST['commentaire_habitat'];

  // Appeler la fonction pour modifier les habitats
  try {
    modifierHabitat($nom_habitat, $description, $commentaire_habitat, $nom_habitat);
    $success = true;
  } catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification des habitats</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php require_once(__DIR__.'/header.php');?>
<h1>Modifications des habitats</h1>
<p>Merci de bien vouloir renseigner le formulaire suivant.</p>

<?php if ($success): ?>
    <p>Modification de l'habitat faite avec succès.</p>
<?php endif; ?>
<form id="js_comptaHabitat_form" method="post" action="compteHabitat.php">

  <label for="nom">Nom</label>
  <input type="text" id="nom" name="name" required>

  <label for="description">Description</label>
  <textarea id="description" name="description" rows="5" cols="33" required></textarea>

  <label for="commentaire_habitat">Commentaire</label>
  <textarea id="commentaire_habitat" name="commentaire_habitat" rows="7" cols="40" required></textarea>

  <input type="submit" value="Enregistrer">

  <input id="js_reinitialisation" type="button" value="Réinitialiser le formulaire">

</form>

<script src="script.js"></script>
</body>
</html>
