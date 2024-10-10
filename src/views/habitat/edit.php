<?php
// Inclure le fichier header
require_once(__DIR__ . '/../header.php');

// Vérifier si l'habitat existe
if (isset($habitat)) {
?>

<h2>Edit Habitat</h2>

<form action="index.php?controller=habitat&action=update&id=<?php echo $habitat['id']; ?>" method="POST">
    <div>
        <label for="nom">Name:</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($habitat['nom']); ?>" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($habitat['description']); ?></textarea>
    </div>
    <div>
        <label for="commentaire_habitat">Comment:</label>
        <textarea id="commentaire_habitat" name="commentaire_habitat" rows="4"><?php echo htmlspecialchars($habitat['commentaire_habitat']); ?></textarea>
    </div>
    <div>
        <button type="submit">Save Changes</button>
    </div>
</form>

<?php
} else {
    // Si l'habitat n'existe pas, afficher un message d'erreur
    echo "<p>Habitat not found. Please check the habitat ID.</p>";
}

// Inclure le fichier footer
require_once(__DIR__ . '/../footer.php');
