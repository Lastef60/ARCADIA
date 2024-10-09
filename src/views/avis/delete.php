<?php
require_once 'controllers/AvisController.php';

$avisController = new AvisController($db);

if (isset($_GET['id'])) {
    $avisController->delete($_GET['id']);
    header('Location: list.php');
}
