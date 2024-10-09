<?php require_once(__DIR__ . '/../header.php'); ?>

<h1>Créer un Nouvel Habitat</h1>

<form method="post" action="/habitat/create">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>

    <label for="description">Description :</label>
    <textarea name="description" id="description" required></textarea>

    <label for="commentaire_habitat">Commentaire :</label>
    <textarea name="commentaire_habitat" id="commentaire_habitat" required></textarea>

    <input type="submit" value="Créer">
</form>
