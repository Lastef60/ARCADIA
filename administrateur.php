<?php
require_once(__DIR__ . '/functions.php'); //recup fichier des fonctions

$pdo = connexionBDD(); //connexion bdd mariadb

// requete pr recuperer liste des animaux pour form
$sql = "SELECT prenom FROM animal"; //recup tous les prenoms des animaux depuis la table animal
$stmt = $pdo->query($sql); //on stock les infos

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>page administrateur</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>Bienvenue José</h1>
  <?php require_once(__DIR__ . '/header.php'); ?> <!--recup fihcier header-->
  <p>Veuillez selectionner votre tâche</p>

  <p>Pour ajouter des nouvelles photos à la base de donnée Arcadia, merci de
    <a class="js_admin_bddimg" href="./upload.html">cliquez ici</a>
  </p>

  <p>Pour gerer les connexions de vos vétérinaires et vos employés, merci de
    <a class="js_admin_bdduser" href="./compteUtilisateur.html">cliquez ici</a>
  </p>

  <p>Afin de gerer les services proposez pour le zoo, merci de vous rendre sur cette page :
    <a class="js_admin_bddservice" href="./compteService.php">page service</a>
  </p>

  <p>Afin de gerer les habitats du zoo, merci de vous rendre sur cette page :
    <a class="js_admin_bddhabitat" href="./compteHabitat.php">page habitat</a>
  </p>

  <p>Afin de gerer les animaux présents dans le zoo, merci de vous rendre sur cette page :
    <a class="js_admin_bddanimal" href="./compteAnimal.html">page animal</a>
  </p>

  <p>Pour voir le nombre de clics sur chaque animal, veuillez visiter le
    <a href="dash.php">dashboard</a>.
  </p>


  <p>Pour consulter le rapport des vétérinaires</p>
  <form method="POST" action="">
    <label for="animal_name">Sélectionner le prénom de l'animal :</label>
    <select id="animal_name" name="animal_name" required>
      <option value="">--Sélectionner un animal--</option>
      <?php
      if ($stmt->rowCount() > 0) { //$stmt->rowCount()= si nombre de ligne > 0
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          //boucle pour chaque ligne. PDO::FETCH_ASSOC = tableau utilise nom de colonne comme clefs
          echo "<option value=\"" . htmlspecialchars($row['prenom']) . "\">" . htmlspecialchars($row['prenom']) . "</option>";
        }
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

    if ($stmt->rowCount() > 0) {
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
  <script src="script.js"></script>
</body>

</html>