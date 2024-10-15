<?php
class Animal {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all animals by habitat
    public function getAnimalsByHabitat($habitat_id) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM animal WHERE habitat_id = :habitat_id');
            $stmt->execute(['habitat_id' => $habitat_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get Animals by Habitat Error: " . $e->getMessage());
            return [];  // Return an empty array in case of error
        }
    }

    // Get a specific animal by ID
    public function getAnimalById($animal_id) {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM animal WHERE animal_id = :animal_id');
            $stmt->execute(['animal_id' => $animal_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get Animal by ID Error: " . $e->getMessage());
            return null;  // Return null in case of error
        }
    }

    // Create a new animal
    public function createAnimal($data) {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO animal (prenom, etat, genre, age, race_id, habitat_id) VALUES (:prenom, :etat, :genre, :age, :race_id, :habitat_id)');
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Create Animal Error: " . $e->getMessage());
            return false;  // Return false in case of error
        }
    }

    // Update an animal
    public function updateAnimal($animal_id, $data) {
        try {
            $data['animal_id'] = $animal_id;
            $stmt = $this->pdo->prepare('UPDATE animal SET prenom = :prenom, etat = :etat, genre = :genre, age = :age, race_id = :race_id, habitat_id = :habitat_id WHERE animal_id = :animal_id');
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Update Animal Error: " . $e->getMessage());
            return false;  // Return false in case of error
        }
    }

    // Delete an animal
    public function deleteAnimal($animal_id) {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM animal WHERE animal_id = :animal_id');
            return $stmt->execute(['animal_id' => $animal_id]);
        } catch (PDOException $e) {
            error_log("Delete Animal Error: " . $e->getMessage());
            return false;  // Return false in case of error
        }
    }
}
