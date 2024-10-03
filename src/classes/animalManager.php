<?php

class AnimalManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllAnimals() {
        $animal = new Animal($this->pdo);
        return $animal->getAllAnimals(); // Utilisation de la méthode de la classe Animal
    }

    public function getReportsByAnimalName($animal_name) {
        // Ta logique ici
    }
}
