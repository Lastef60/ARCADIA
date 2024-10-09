<h1><?= htmlspecialchars($animal['prenom']) ?></h1>
<p>Status: <?= htmlspecialchars($animal['etat']) ?></p>
<p>Age: <?= htmlspecialchars($animal['age']) ?></p>
<p>Gender: <?= htmlspecialchars($animal['genre']) ?></p>
<a href="index.php?controller=animal&action=edit&id=<?= $animal['animal_id'] ?>">Edit</a>
<a href="index.php?controller=animal&action=delete&id=<?= $animal['animal_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
