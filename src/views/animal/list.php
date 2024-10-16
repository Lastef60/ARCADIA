<?php if (empty($animals)): ?>
    <p>Pas d'animaux trouvé.</p>
<?php else: ?>
    <ul>
    <h1>Les animaux dans cet habitat</h1>
        <?php foreach ($animals as $animal): ?>
            <li>
                <a href="index.php?controller=animal&action=show&id=<?= $animal['animal_id'] ?>">
                    <?= htmlspecialchars($animal['prenom']) ?> (<?= htmlspecialchars($animal['etat']) ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>