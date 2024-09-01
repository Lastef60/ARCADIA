<?php
require_once(__DIR__ . '/functions.php');

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $nomanimal = $_POST['nomanimal'];
  $date = $_POST['date'];
  $detail = $_POST['detail'];
  $etatanimal = $_POST['etat_animal'];
  $nourriture = $_POST['nourriture'];
  $grammage = $_POST['grammage'];

  // Appeler la fonction pour ajouter le rapport vétérinaire
  try {
    ajouterRapportVeto($date, $detail, $etatanimal, $nourriture, $grammage, $nomanimal);
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
  <title>Page Veterinaire</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php require_once(__DIR__ . '/header.php'); ?>

  <h1>ENREGISTREMENT DES RAPPORTS</h1>

  <p>Merci de bien vouloir renseigner le formulaire suivant après chaque consultation auprès d'un animal.</p>
  <p> Attention , la date du rapport doit être la date de visite de l'animal, même si le rapport n'est pas fait le même jour (j +1 maximum)</p>

  <?php if ($success): ?>
    <p>Rapport vétérinaire ajouté avec succès.</p>
  <?php endif; ?>

  <form class="css_form" id="js_veterinaire_form" method="post" action="veterinaire.php">
    <label for="nomanimal">Prénom de l'animal :</label>
    <input type="text" id="nomanimal" name="nomanimal" required>

    <label for="date">Date du rapport :</label>
    <input type="date" id="date" name="date" required>

    <label for="detail">Détail à mentionner :</label>
    <textarea id="detail" name="detail" rows="5" cols="33" required></textarea>

    <label for="etat_animal">État de santé de l'animal :</label>
    <input type="text" id="etat_animal" name="etat_animal" required>

    <label for="nourriture">Nourriture donnée :</label>
    <input type="text" id="nourriture" name="nourriture" required>

    <label for="grammage">Quantité donnée :</label>
    <input type="text" id="grammage" name="grammage" required>

    <input type="submit" value="Enregistrer">

    <input id="js_reinitialisation" type="button" value="Réinitialiser le formulaire">
  </form>

  <p>Afin de gerer les habitats du zoo, merci de vous rendre sur cette page :
    <a class=js_admin_bddhabitat href="./compteHabitat.php">page habitat</a>


    <script src="script.js"></script>
</body>

</html>