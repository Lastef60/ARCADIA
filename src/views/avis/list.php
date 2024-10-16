<?php
// Vérifie si la variable $habitats est définie et son contenu
if (isset($habitats)) {
  var_dump($habitats); // Affiche le contenu de $habitats pour le débogage
}

// Vérification que la variable $habitats est définie et contient des données
if (empty($habitats)) {
  echo "<p>Aucun habitat disponible.</p>";
} else {
  foreach ($habitats as $habitat):
    // Récupérer le nom et l'image de l'habitat
    $habitatName = isset($habitat['nom']) ? $habitat['nom'] : 'inconnu';
    $habitatImage = "/public/uploads/img/{$habitatName}_habitat.jpg";
?>
    <div class="habitat-item">
      <img class="css_img_habitats js_habitat_img" id="js_img_<?= htmlspecialchars($habitatName) ?>habitat"
        src="<?= $habitatImage ?>" alt="habitat <?= htmlspecialchars($habitatName) ?>"
        data-habitat="<?= $habitat['habitat_id'] ?>">

      <p id="js_descript_<?= htmlspecialchars($habitatName) ?>habitat">
        <?= strtoupper(htmlspecialchars($habitatName)) ?> :
        <?= htmlspecialchars($habitat['description']) . "<br>" . htmlspecialchars($habitat['commentaire_habitat']); ?>
      </p>

      <div class="js_habitat_animals" data-habitat="<?= $habitat['habitat_id'] ?>">
        <?php
        // Vérifier si des animaux sont disponibles pour cet habitat
        if (isset($animalsByHabitat[$habitat['habitat_id']]) && !empty($animalsByHabitat[$habitat['habitat_id']])):
          foreach ($animalsByHabitat[$habitat['habitat_id']] as $animal):
            $animalName = strtolower($animal['prenom']);
            $fileExtension = ($animalName === 'aslan') ? 'png' : 'jpg';
            $animalImage = "/public/uploads/img/{$habitatName}_{$animalName}.{$fileExtension}";
        ?>
            <div class="animal-item">
              <img class="js_animal css_img" src="<?= $animalImage ?>"
                data-animal="<?= htmlspecialchars($animal['prenom']) ?>"
                alt="<?= htmlspecialchars($animal['prenom']) ?>">
              <div class="js_animal_description" data-animal="<?= htmlspecialchars($animal['prenom']) ?>">
                <?php foreach ($animal as $key => $value): ?>
                  <?php if ($key !== 'animal_id' && $key !== 'habitat_id'): ?>
                    <p><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $key))) ?>: <?= htmlspecialchars($value) ?></p>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun animal disponible dans cet habitat.</p>
        <?php endif; ?>
      </div>
    </div>
<?php
  endforeach;
}
