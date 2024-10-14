<?php

require_once(__DIR__ . '/../models/Habitat.php');
require_once(__DIR__ . '/../models/Animal.php'); // Inclure le modèle Animal
require_once(__DIR__ . '/../models/Database.php');

class HabitatController
{
    private $habitatModel;
    private $animalModel; // Ajouter une propriété pour le modèle Animal

    // Injecter la connexion PDO dans le constructeur
    public function __construct($pdo)
    {
        $this->habitatModel = new Habitat($pdo);
        $this->animalModel = new Animal($pdo); // Initialiser le modèle Animal
    }

    // Afficher tous les habitats et les animaux associés
    public function list()
    {
        $habitats = $this->habitatModel->getAll(); // Obtenir tous les habitats
        
        // Récupérer les animaux pour chaque habitat
        $animalsByHabitat = [];
        foreach ($habitats as $habitat) {
            $animalsByHabitat[$habitat['habitat_id']] = $this->animalModel->getAnimalsByHabitat($habitat['habitat_id']);
        }

        // Passer les habitats et les animaux à la vue
        require_once(__DIR__ . '/../views/habitat/list.php'); // Charger la vue pour afficher les habitats
    }

    // Afficher les détails d'un habitat et ses animaux
    public function show($id)
    {
        $habitat = $this->habitatModel->getById($id);
        $animals = $this->animalModel->getAnimalsByHabitat($id); // Récupérer les animaux de l'habitat
        require_once(__DIR__ . '/../views/habitat/show.php'); // Vue des détails d'un habitat
    }

    // Créer un nouvel habitat
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $commentaire = $_POST['commentaire_habitat'];
            $this->habitatModel->create($nom, $description, $commentaire);
            header('Location: /habitats'); // Rediriger après création
            exit;
        } else {
            require_once(__DIR__ . '/../views/habitat/create.php'); // Charger la vue pour créer un habitat
        }
    }

    // Mettre à jour un habitat
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $commentaire = $_POST['commentaire_habitat'];
            $this->habitatModel->update($id, $nom, $description, $commentaire);
            header('Location: /habitats'); // Rediriger après mise à jour
            exit;
        } else {
            $habitat = $this->habitatModel->getById($id);
            require_once(__DIR__ . '/../views/habitat/edit.php'); // Charger la vue pour éditer un habitat
        }
    }

    // Supprimer un habitat
    public function delete($id)
    {
        $this->habitatModel->delete($id);
        header('Location: /habitats'); // Rediriger après suppression
        exit;
    }

    // Méthode pour mettre à jour un commentaire d'un habitat
    public function updateComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['habitat_id'])) {
            $habitatId = $_POST['habitat_id'];
            $commentaire = $_POST['commentaire_habitat'];

            $this->habitatModel->updateComment($habitatId, $commentaire);
            header('Location: /employe.php'); // Rediriger après mise à jour
            exit;
        } else {
            echo "<p>Requête invalide. Veuillez soumettre le formulaire avec les informations nécessaires.</p>";
        }
    }
}
