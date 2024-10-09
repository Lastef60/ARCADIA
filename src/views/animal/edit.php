<h1>Edit Animal</h1>
<form method="POST" action="index.php?controller=animal&action=edit&id=<?= $animal['animal_id'] ?>">
    <label>Prénom:</label><input type="text" name="prenom" value="<?= htmlspecialchars($animal['prenom']) ?>">
    <label>État:</label><input type="text" name="etat" value="<?= htmlspecialchars($animal['etat']) ?>">
    <label>Genre:</label><input type="text" name="genre" value="<?= htmlspecialchars($animal['genre']) ?>">
    <label>Âge:</label><input type="number" name="age" value="<?= htmlspecialchars($animal['age']) ?>">
    <label>Race:</label><input type="number" name="race_id" value="<?= htmlspecialchars($animal['race_id']) ?>">
    <label>Habitat:</label><input type="number" name="habitat_id" value="<?= htmlspecialchars($animal['habitat_id']) ?>">
    <button type="submit">Save</button>
</form>
