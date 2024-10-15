<?php
require_once(__DIR__ . '/../models/Animal.php');

class AnimalController
{
    private $animalModel;

    public function __construct($pdo)
    {
        $this->animalModel = new Animal($pdo);
    }

    // List animals by habitat
    public function list($habitat_id)
    {
        $animals = $this->animalModel->getAnimalsByHabitat($habitat_id);
        require_once(__DIR__.'/../views/animal/list.php');
    }

    // Show animal
    public function show($animal_id)
    {
        $animal = $this->animalModel->getAnimalById($animal_id);
        require_once(__DIR__.'/../views/animal/show.php');
    }

    // Create animal
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'prenom' => $_POST['prenom'],
                'etat' => $_POST['etat'],
                'genre' => $_POST['genre'],
                'age' => $_POST['age'],
                'race_id' => $_POST['race_id'],
                'habitat_id' => $_POST['habitat_id']
            ];

            if ($this->animalModel->createAnimal($data)) {
                header('Location: index.php?controller=animal&action=list');
            } else {
                // Handle error (e.g., set a flash message)
                echo "Error creating animal.";
            }
        } else {
            require_once(__DIR__.'/../views/animal/create.php');
        }
    }

    // Edit animal
    public function edit($animal_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'prenom' => $_POST['prenom'],
                'etat' => $_POST['etat'],
                'genre' => $_POST['genre'],
                'age' => $_POST['age'],
                'race_id' => $_POST['race_id'],
                'habitat_id' => $_POST['habitat_id']
            ];

            if ($this->animalModel->updateAnimal($animal_id, $data)) {
                header('Location: index.php?controller=animal&action=list');
            } else {
                // Handle error (e.g., set a flash message)
                echo "Error updating animal.";
            }
        } else {
            $animal = $this->animalModel->getAnimalById($animal_id);
            require_once(__DIR__.'/../views/animal/edit.php');
        }
    }

    // Delete animal
    public function delete($animal_id)
    {
        if ($this->animalModel->deleteAnimal($animal_id)) {
            header('Location: index.php?controller=animal&action=list');
        } else {
            // Handle error (e.g., set a flash message)
            echo "Error deleting animal.";
        }
    }
}
