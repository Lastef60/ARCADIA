<h1>Animals in this Habitat</h1>
<ul>
    <?php foreach ($animals as $animal): ?>
        <li>
            <a href="index.php?controller=animal&action=show&id=<?= $animal['animal_id'] ?>">
                <?= htmlspecialchars($animal['prenom']) ?> (<?= htmlspecialchars($animal['etat']) ?>)
            </a>
        </li>
    <?php endforeach; ?>
</ul>
