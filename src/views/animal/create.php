<h1>Create New Animal</h1>
<form method="POST" action="index.php?controller=animal&action=create">
    <label>Prénom:</label><input type="text" name="prenom" required>
    
    <label>État:</label><input type="text" name="etat" required>
    
    <label>Genre:</label><input type="text" name="genre" required>
    
    <label>Âge:</label><input type="number" name="age" required>
    
    <label>Race:</label>
    <select name="race_id" required>
        <option value="">Select Race</option>
        <?php foreach ($races as $race): ?>
            <option value="<?= $race['id'] ?>"><?= htmlspecialchars($race['name']) ?></option>
        <?php endforeach; ?>
    </select>
    
    <label>Habitat:</label>
    <select name="habitat_id" required>
        <option value="">Select Habitat</option>
        <?php foreach ($habitats as $habitat): ?>
            <option value="<?= $habitat['id'] ?>"><?= htmlspecialchars($habitat['name']) ?></option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit">Create</button>
</form>
