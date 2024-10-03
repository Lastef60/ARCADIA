<?php

require_once(__DIR__ . '/../core/functions.php');

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
$role_id = isset($_POST['role_id']) ? $_POST['role_id'] : null;

$pdo = connexionBDD();
