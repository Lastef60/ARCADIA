<?php
require_once(__DIR__.'/functions.php');

$pdo = connexionBDD();

// Requête pour tous les habitats
$queryHabitats = $pdo->prepare("SELECT habitat_id, description, commentaire_habitat FROM habitat WHERE habitat_id IN (4, 5, 6)");
$queryHabitats->execute();
$habitats = $queryHabitats->fetchAll(PDO::FETCH_ASSOC);

// Requête pour tous les animaux avec leur habitat, race et rapport vétérinaire
//apportt modif pour que le dernier rapport veto soit recup :  WHERE rv.date = (
        //SELECT MAX(rv2.date)
        //FROM rapport_veterinaire rv2
        //WHERE rv2.animal_id = a.animal_id
    
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

// Organiser les animaux par habitat
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

require_once(__DIR__.'/header.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos habitats et leurs animaux</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php foreach ($habitats as $habitat): ?>
        <?php 
        // Utiliser le nom d'habitat pour les noms de fichiers
        $habitatName = $habitatMapping[$habitat['habitat_id']];
        $habitatImage = "./uploads/img/{$habitatName}_habitat.jpg";
        ?>
        <!-- Habitat Section -->
        <img class="css_img_habitats js_habitat_img" id="js_img_<?= $habitatName ?>habitat" src="<?= $habitatImage ?>" alt="habitat <?= htmlspecialchars($habitatName) ?>" data-habitat="<?= $habitat['habitat_id'] ?>">
        <p id="js_descript_<?= $habitatName ?>habitat">
            <?= strtoupper($habitatName) ?> :
            <?= htmlspecialchars($habitat['description']) . "<br>" . htmlspecialchars($habitat['commentaire_habitat']); ?>
        </p>
        <div class="js_habitat_animals" data-habitat="<?= $habitat['habitat_id'] ?>">
            <?php if (isset($animalsByHabitat[$habitat['habitat_id']])): ?>
                <?php foreach ($animalsByHabitat[$habitat['habitat_id']] as $animal): ?>
                    <?php 
                    $animalName = strtolower($animal['prenom']);
                    // Spécifique pour Aslan car png
                    $fileExtension = ($animalName === 'aslan') ? 'png' : 'jpg';
                    $animalImage = "./uploads/img/{$habitatName}_{$animalName}.{$fileExtension}";
                    ?>
                    <img class="js_animal css_img" src="<?= $animalImage ?>" data-animal="<?= htmlspecialchars($animal['prenom']) ?>" alt="<?= htmlspecialchars($animal['prenom']) ?>">
                    <div class="js_animal_description" data-animal="<?= htmlspecialchars($animal['prenom']) ?>">
                        <?php foreach ($animal as $key => $value): ?>
                            <?php if ($key !== 'animal_id' && $key !== 'habitat_id'): ?>
                                <p><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $key))) ?>: <?= htmlspecialchars($value) ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <script src="script.js"></script>
</body>
</html>