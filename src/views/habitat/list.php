<div class="habitat-gallery">
    <?php foreach ($habitats as $habitat): ?>
        <div class="habitat-item">
            <a href="/habitat/<?= $habitat['habitat_id'] ?>">
                <img src="/uploads/img/<?= htmlspecialchars(strtolower($habitat['nom'])) ?>_habitat.jpg" alt="<?= htmlspecialchars($habitat['nom']) ?>">
                <p><?= htmlspecialchars($habitat['nom']) ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</div>
