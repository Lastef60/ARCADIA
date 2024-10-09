<?php

require_once(__DIR__ . '/controllers/HabitatController.php');
require_once(__DIR__ . '/controllers/ServiceController.php');
require_once(__DIR__ . '/controllers/HoraireController.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/' || $uri === '/index') {
    // Show the homepage
    $controller = new ServiceController();
    $controller->index();
} elseif ($uri === '/habitats') {
    // Show all habitats
    $controller = new HabitatController();
    $controller->list();
} elseif (preg_match('/\/habitat\/(\d+)/', $uri, $matches)) {
    // Show a specific habitat based on ID
    $controller = new HabitatController();
    $controller->show($matches[1]);
} elseif ($uri === '/habitat/create') {
    // Create a new habitat
    $controller = new HabitatController();
    $controller->create();
} elseif (preg_match('/\/habitat\/edit\/(\d+)/', $uri, $matches)) {
    // Update habitat
    $controller = new HabitatController();
    $controller->update($matches[1]);
} elseif (preg_match('/\/habitat\/delete\/(\d+)/', $uri, $matches)) {
    // Delete habitat
    $controller = new HabitatController();
    $controller->delete($matches[1]);
} else {
    echo "404 - Page not found";
}
