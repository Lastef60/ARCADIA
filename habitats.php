<?php
require_once(__DIR__ . '/functions.php'); //recuperation fichier functions
require_once(__DIR__ . '/vendor/autoload.php'); //recuperation fichier autolaods generer par composer

//connexion a Mariadb
$pdo = connexionBDD();

// Connexion à MongoDB
$animalCollection = connexionArcadiaMongoBDD();

// Requête pour recup données sur bdd mariadb table "habitat" pour tous les habitats
$queryHabitats = $pdo->prepare("SELECT habitat_id, description, commentaire_habitat FROM habitat WHERE habitat_id IN (4, 5, 6)");
$queryHabitats->execute();
$habitats = $queryHabitats->fetchAll(PDO::FETCH_ASSOC);

// Requête pour tous les animaux avec leur habitat, race et rapport vétérinaire
//recup sur tables de mariadb animal, race et rapport_veterinaire
//on selectionne le dernier rapport veterinaire
$queryAnimals = $pdo->prepare(
  "SELECT
                a.animal_id,
                a.prenom,
                a.genre,
                a.age,
                a.etat AS historique,
                r.label AS race,
                rv.etat_animal AS rapport_veterinaire,
                rv.date AS rapport_date,
                a.habitat_id
            FROM animal a
            JOIN race r ON a.race_id = r.race_id
            JOIN rapport_veterinaire rv ON a.animal_id = rv.animal_id
            WHERE rv.date = (
                SELECT MAX(rv2.date)
                FROM rapport_veterinaire rv2
                WHERE rv2.animal_id = a.animal_id
            )
            AND a.habitat_id IS NOT NULL"
);
$queryAnimals->execute();
$animals = $queryAnimals->fetchAll(PDO::FETCH_ASSOC);

// Organiser les animaux par habitat pour chaq animal
$animalsByHabitat = [];
foreach ($animals as $animal) {
  $animalsByHabitat[$animal['habitat_id']][] = $animal;
}

// indication id_habitat = nom_habitat
$habitatMapping = [
  4 => 'savane',
  5 => 'jungle',
  6 => 'marais'
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Explorez les habitats du Zoo Arcadia, y compris la savane, la jungle et le marais. Découvrez les animaux qui y résident, avec des informations détaillées sur leur race, leur état de santé et leur environnement. Préparez votre visite en apprenant tout sur nos fascinants écosystèmes et leurs habitants.">
  <title>Nos habitats et leurs animaux</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body id="js_habitats_page">
  <?php
  require_once(__DIR__ . '/header.php'); // recuperation page header
  foreach ($habitats as $habitat): ?>
    <?php
    // Utiliser le nom d'habitat pour les noms de fichiers
    $habitatName = $habitatMapping[$habitat['habitat_id']];
    $habitatImage = "./uploads/img/{$habitatName}_habitat.jpg";
    ?>
    <!-- Habitat Section -->

    <!--affichage des img habitats-->
    <div class="css_habitat_container">
    <img class="css_img_habitats js_habitat_img" src="<?= $habitatImage ?>" alt="habitat <?= htmlspecialchars($habitatName) ?>" data-habitat="<?= $habitat['habitat_id'] ?>">

      
      <!-- Description de l'habitat, cachée par défaut et apparaissant au survol -->
      <p id="js_descript_<?= $habitatName ?>habitat" class="css_habitat_description animate__animated">
        <?= strtoupper($habitatName) ?> :
        <?= htmlspecialchars($habitat['description']) . "<br>" . htmlspecialchars($habitat['commentaire_habitat']); ?>
      </p>
    </div>
    
    <!--container des animaux:
    data-habitat="= $habitat['habitat_id'] pour faire selection des animaux selon habitat -->
    <div class="js_habitat_animals css_habitat_animal" data-habitat="<?= $habitat['habitat_id'] ?>">
      <!--if (isset($animalsByHabitat[$habitat['habitat_id']])) : verifie si existe animaux pr l'habitat-->
      <?php if (isset($animalsByHabitat[$habitat['habitat_id']])): ?>
        <!--boucle pour chaque animal-->
        <?php foreach ($animalsByHabitat[$habitat['habitat_id']] as $animal): ?>
          <?php
          //strolower : minuscules
          $animalName = strtolower($animal['prenom']);
          // Spécifique pour Aslan car png
          $fileExtension = ($animalName === 'aslan') ? 'png' : 'jpg';
          $animalImage = "./uploads/img/{$habitatName}_{$animalName}.{$fileExtension}";
          ?>
          <!--afichage de la description des animaux-->
          <img class="js_animal css_habitat_imgAnimal" src="<?= $animalImage ?>" data-animal="<?= htmlspecialchars($animal['prenom']) ?>" alt="<?= htmlspecialchars($animal['prenom']) ?>">
          <div class="js_animal_description css_animal_description" data-animal="<?= htmlspecialchars($animal['prenom']) ?>">
            <?php foreach ($animal as $key => $value): ?>
              <?php if ($key !== 'animal_id' && $key !== 'habitat_id'): ?>
                <p><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $key))) ?>: <?= htmlspecialchars($value) ?></p>
                <!--
                str_replace remplace les _ par des espaces
                ucfirst() = 1ere lettres en majuscule
                -->
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

  <?php require_once(__DIR__.'/footer.php');?>

  <script src="script.js"></script>
</body>

</html>
