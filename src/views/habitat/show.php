<?php require_once(__DIR__ . '/../header.php'); ?>

<h1>Habitat : <?= htmlspecialchars($habitat['nom']) ?></h1>
<p>Description : <?= htmlspecialchars($habitat['description']) ?></p>
<p>Commentaire : <?= htmlspecialchars($habitat['commentaire_habitat']) ?></p>

<h2>Animaux dans cet habitat</h2>
<div class="animal-gallery">
    <?php foreach ($animalsByHabitat[$habitat['habitat_id']] as $animal): ?>
        <div class="animal-item">
            <img src="./uploads/img/<?= htmlspecialchars(strtolower($animal['prenom'])) ?>.jpg" alt="<?= htmlspecialchars($animal['prenom']) ?>">
            <p><?= htmlspecialchars($animal['prenom']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
