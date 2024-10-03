<?php

class Animal {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllAnimals() {
        return $this->pdo->query("SELECT * FROM animal")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimalById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animal WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fichierAnimal() {
        $queryAnimals = $this->pdo->prepare(
            "SELECT
                a.prenom,
                a.genre,
                a.age,
                a.etat AS historique,
                r.label AS race,
                rv.etat_animal AS rapport_veterinaire
            FROM animal a
            JOIN rapport_veterinaire rv ON a.animal_id = rv.animal_id
            JOIN race r ON a.race_id = r.race_id"
        );

        if (!$queryAnimals->execute()) {
            $errorInfo = $queryAnimals->errorInfo();
            echo "SQL Error: " . htmlspecialchars($errorInfo[2]);
            exit;
        }

        return $queryAnimals->fetchAll(PDO::FETCH_ASSOC);
    }
}

