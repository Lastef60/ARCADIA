<?php

require_once(__DIR__.'/functions.php');

$username = $_POST['username'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role_id = $_POST['role_id'];

$pdo = connexionBDD();
