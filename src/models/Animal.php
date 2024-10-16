<?php
class Animal
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Obtenir les animaux par habitat
    public function getAnimalsByHabitat($habitat_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM animal WHERE habitat_id = :habitat_id");
        $stmt->execute(['habitat_id' => $habitat_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtenir un animal par son ID
    public function getAnimalById($animal_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM animal WHERE animal_id = :animal_id");
        $stmt->execute(['animal_id' => $animal_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un animal
    public function createAnimal($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO animal (prenom, etat, genre, age, race_id, habitat_id) VALUES (:prenom, :etat, :genre, :age, :race_id, :habitat_id)");
        return $stmt->execute($data);
    }

    // Mettre à jour un animal
    public function updateAnimal($animal_id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE animal SET prenom = :prenom, etat = :etat, genre = :genre, age = :age, race_id = :race_id, habitat_id = :habitat_id WHERE animal_id = :animal_id");
        $data['animal_id'] = $animal_id;
        return $stmt->execute($data);
    }

    // Supprimer un animal
    public function deleteAnimal($animal_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM animal WHERE animal_id = :animal_id");
        return $stmt->execute(['animal_id' => $animal_id]);
    }
}
