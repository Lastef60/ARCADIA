<?php

require_once(__DIR__ . '/../models/Habitat.php');
require_once(__DIR__ . '/../models/Animal.php');
require_once(__DIR__ . '/../models/Database.php');

class HabitatController
{
  private $habitatModel;
  private $animalModel;

  public function __construct()
  {
    // Initialiser PDO
    $pdo = (new Database())->getPdo();

    // Passer PDO au modèle Habitat
    $this->habitatModel = new Habitat($pdo);
    $this->animalModel = new Animal($pdo);
  }

  public function list()
  {
    // Récupérer tous les habitats
    $habitats = $this->habitatModel->getAll();

    // Déboguer le contenu des habitats
    var_dump($habitats); // Ajoute cette ligne pour voir ce qui est retourné

    // Récupérer les animaux par habitat
    $animalsByHabitat = [];
    foreach ($habitats as $habitat) {
      $animalsByHabitat[$habitat['habitat_id']] = $this->animalModel->getAnimalsByHabitat($habitat['habitat_id']);
    }

    // Passer les habitats et les animaux associés à la vue
    require_once(__DIR__ . '/../views/habitat/list.php');
  }

  public function show($id)
  {
    // Récupérer un habitat spécifique en fonction de son ID
    $habitat = $this->habitatModel->getById($id);
    if (!$habitat) {
      // Redirection ou message d'erreur si l'habitat n'existe pas
      echo "L'habitat demandé n'existe pas.";
      return;
    }

    // Récupérer les animaux de cet habitat
    $animals = $this->animalModel->getAnimalsByHabitat($id);

    // Passer l'habitat et ses animaux associés à la vue
    require_once(__DIR__ . '/../views/habitat/show.php');
  }

  // Méthode pour créer un habitat
  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = $_POST['nom'];
      $description = $_POST['description'];
      $commentaire_habitat = $_POST['commentaire_habitat'];

      // Appel du modèle pour ajouter un nouvel habitat
      if ($this->habitatModel->create($nom, $description, $commentaire_habitat)) {
        // Redirection après la création
        header('Location: /habitat/list');
        exit;
      }
    } else {
      require_once(__DIR__ . '/../views/habitat/create.php');
    }
  }

  // Méthode pour éditer un habitat
  public function edit($id)
  {
    $habitat = $this->habitatModel->getById($id);
    if (!$habitat) {
      echo "L'habitat demandé n'existe pas.";
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = $_POST['nom'];
      $description = $_POST['description'];
      $commentaire_habitat = $_POST['commentaire_habitat'];

      if ($this->habitatModel->update($id, $nom, $description, $commentaire_habitat)) {
        header('Location: /habitat/list');
        exit;
      }
    }

    require_once(__DIR__ . '/../views/habitat/edit.php');
  }

  // Méthode pour supprimer un habitat
  public function delete($id)
  {
    if ($this->habitatModel->delete($id)) {
      header('Location: /habitat/list');
      exit;
    } else {
      echo "Erreur lors de la suppression de l'habitat.";
    }
  }
}
