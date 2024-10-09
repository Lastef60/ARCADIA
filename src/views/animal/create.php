<h1>Create New Animal</h1>
<form method="POST" action="index.php?controller=animal&action=create">
    <label>Prénom:</label><input type="text" name="prenom">
    <label>État:</label><input type="text" name="etat">
    <label>Genre:</label><input type="text" name="genre">
    <label>Âge:</label><input type="number" name="age">
    <label>Race:</label><input type="number" name="race_id">
    <label>Habitat:</label><input type="number" name="habitat_id">
    <button type="submit">Create</button>
</form>
