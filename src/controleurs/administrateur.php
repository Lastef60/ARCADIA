<?php
require_once(__DIR__ . '/../core/Database.php'); // récupération de la classe Database
require_once(__DIR__ . '/../core/AnimalManager.php'); // récupération de la classe AnimalManager

$db = new Database(); // Connexion à la BDD
$pdo = $db->getPDO(); // obtenir l'objet PDO

$animalManager = new AnimalManager($pdo); // Instancier AnimalManager

// Requête pour récupérer la liste des animaux pour le formulaire
$animals = $animalManager->getAllAnimals(); // récupérer tous les prénoms des animaux
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Administrateur</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>

<body>
  <h1>Bienvenue José</h1>
  <?php require_once(__DIR__ . '/../views/header.php'); ?>

  <p>Veuillez sélectionner votre tâche</p>

  <p>Pour ajouter des nouvelles photos à la base de données Arcadia, merci de
    <a class="js_admin_bddimg" href="https://stephaniet.alwaysdata.net/formTelechargementImg.php">cliquez ici</a>
  </p>

  <p>Pour gérer les connexions de vos vétérinaires et vos employés, merci de
    <a class="js_admin_bdduser" href="https://stephaniet.alwaysdata.net/compteUtilisateur.html">cliquez ici</a>
  </p>

  <p>Afin de gérer les services proposés pour le zoo, merci de vous rendre sur cette page :
    <a class="js_admin_bddservice" href="https://stephaniet.alwaysdata.net/compteService.php">page service</a>
  </p>

  <p>Afin de gérer les habitats du zoo, merci de vous rendre sur cette page :
    <a class="js_admin_bddhabitat" href="https://stephaniet.alwaysdata.net/compteHabitat.php">page habitat</a>
  </p>

  <p>Afin de gérer les animaux présents dans le zoo, merci de vous rendre sur cette page :
    <a class="js_admin_bddanimal" href="https://stephaniet.alwaysdata.net/compteAnimal.php">page animal</a>
  </p>

  <p>Pour voir le nombre de clics sur chaque animal, veuillez visiter le
    <a href="https://stephaniet.alwaysdata.net/dash.php">dashboard</a>.
  </p>

  <p>Pour consulter le rapport des vétérinaires</p>
  <form method="POST" action="">
    <label for="animal_name">Sélectionner le prénom de l'animal :</label>
    <select id="animal_name" name="animal_name" required>
      <option value="">--Sélectionner un animal--</option>
      <?php
      foreach ($animals as $animal) { // Utilisation de la méthode getAllAnimals
        echo "<option value=\"" . htmlspecialchars($animal['prenom']) . "\">" . htmlspecialchars($animal['prenom']) . "</option>";
      }
      ?>
    </select>
    <input type="submit" value="Rechercher">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_name = $_POST['animal_name'];

    // Requête SQL pour obtenir les rapports
    $sql = "SELECT rv.date, rv.detail, rv.etat_animal, rv.nourriture, rv.grammage 
              FROM rapport_veterinaire rv 
              JOIN animal a ON rv.animal_id = a.animal_id 
              WHERE a.prenom = :prenom";

    // Préparation et exécution de la requête
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['prenom' => $animal_name]);

    // Vérifie si le statement a bien des lignes
    if ($stmt && $stmt->rowCount() > 0) { // Assure-toi que $stmt est valide
      echo "<h2>Rapports pour l'animal : " . htmlspecialchars($animal_name) . "</h2>";
      echo "<table class='css_table'>";
      echo "<tr><th>Date</th><th>Détail</th><th>État de l'animal</th><th>Nourriture</th><th>Grammage</th></tr>";

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['detail']) . "</td>";
        echo "<td>" . htmlspecialchars($row['etat_animal']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nourriture']) . "</td>";
        echo "<td>" . htmlspecialchars($row['grammage']) . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<p>Aucun rapport trouvé pour cet animal.</p>";
    }
  }
  ?>

  <script src="../public/script.js"></script>
</body>

</html>