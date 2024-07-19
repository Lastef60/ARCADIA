<?php 
require_once(__DIR__.'/functions.php');

$pdo = connexionBDD();

//pour recuperer les services depuis la bdd
$services = $pdo->query("SELECT * FROM service")->fetchAll(PDO::FETCH_ASSOC);

//por recuperer les horaires depuis la bdd
$horaires = $pdo->query("SELECT * FROM horaire")->fetchAll(PDO::FETCH_ASSOC);

//pour recuperer les images  'service_'
$query = $pdo->query("SELECT image_name FROM image WHERE image_name LIKE 'service_%'");
$images = $query->fetchAll(PDO::FETCH_ASSOC);

?>
