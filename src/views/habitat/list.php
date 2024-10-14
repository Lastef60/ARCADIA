<?php foreach ($habitats as $habitat): ?>
  <?php
  $habitatName = $habitatMapping[$habitat['habitat_id']];
  $habitatImage = "/public/uploads/img/{$habitatName}_habitat.jpg";
  ?>
  <div class="habitat-item">
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
          $fileExtension = ($animalName === 'aslan') ? 'png' : 'jpg';
          $animalImage = "/public/uploads/img/{$habitatName}_{$animalName}.{$fileExtension}";
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
  </div>
<?php endforeach; ?>