<?php
// Assurez-vous que la variable $avis est définie et contient des données
if (empty($avis)) {
    echo "<p>Aucun avis disponible.</p>";
} else {
    echo "<h2>Liste des Avis</h2>";
    foreach ($avis as $avisItem) {
        echo "<div class='avis-item'>";
        echo "<h3>" . htmlspecialchars($avisItem['titre']) . "</h3>";
        echo "<p><strong>Auteur:</strong> " . htmlspecialchars($avisItem['auteur']) . "</p>";
        echo "<p><strong>Commentaire:</strong> " . htmlspecialchars($avisItem['commentaire']) . "</p>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($avisItem['date']) . "</p>";
        echo "</div>";
    }
}
?>

<!-- Formulaire pour ajouter un nouvel avis -->
<h2>Ajouter un Avis</h2>
<form action="<?php echo $baseUrl; ?>/avis/create.php" method="POST">
    <label for="titre">Titre:</label>
    <input type="text" id="titre" name="titre" required>
    
    <label for="auteur">Auteur:</label>
    <input type="text" id="auteur" name="auteur" required>
    
    <label for="commentaire">Commentaire:</label>
    <textarea id="commentaire" name="commentaire" required></textarea>
    
    <button type="submit">Ajouter Avis</button>
</form>
