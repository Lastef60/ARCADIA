<?php

class Habitat
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  // READ - Récupérer tous les habitats
  public function getAll()
  {
    try {
      $stmt = $this->pdo->query('SELECT * FROM habitat');
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Afficher un message de débogage pour vérifier le résultat
      if (empty($results)) {
        echo "Aucune donnée trouvée dans la table habitat.";
      } else {
        echo "Données récupérées avec succès.";
        var_dump($results); // Afficher le contenu exact pour confirmation
      }

      return $results;
    } catch (PDOException $e) {
      error_log("Get All Habitats Error: " . $e->getMessage());
      echo "Erreur lors de la récupération des habitats : " . $e->getMessage(); // Afficher le message d'erreur
      return [];  // Retourner un tableau vide en cas d'erreur
    }
  }


  // CREATE - Ajouter un habitat
  public function create($nom, $description, $commentaire_habitat)
  {
    try {
      $stmt = $this->pdo->prepare('INSERT INTO habitat (nom, description, commentaire_habitat) VALUES (?, ?, ?)');
      return $stmt->execute([$nom, $description, $commentaire_habitat]);
    } catch (PDOException $e) {
      error_log("Create Habitat Error: " . $e->getMessage());
      return false;  // Return false in case of error
    }
  }

  // READ - Récupérer un habitat par ID
  public function getById($id)
  {
    try {
      $stmt = $this->pdo->prepare('SELECT * FROM habitat WHERE habitat_id = ?');
      $stmt->execute([$id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Get Habitat by ID Error: " . $e->getMessage());
      return null;  // Return null in case of error
    }
  }

  // UPDATE - Modifier un habitat
  public function update($id, $nom, $description, $commentaire_habitat)
  {
    try {
      $stmt = $this->pdo->prepare('UPDATE habitat SET nom = ?, description = ?, commentaire_habitat = ? WHERE habitat_id = ?');
      return $stmt->execute([$nom, $description, $commentaire_habitat, $id]);
    } catch (PDOException $e) {
      error_log("Update Habitat Error: " . $e->getMessage());
      return false;  // Return false in case of error
    }
  }

  // DELETE - Supprimer un habitat
  public function delete($id)
  {
    try {
      $stmt = $this->pdo->prepare('DELETE FROM habitat WHERE habitat_id = ?');
      return $stmt->execute([$id]);
    } catch (PDOException $e) {
      error_log("Delete Habitat Error: " . $e->getMessage());
      return false;  // Return false in case of error
    }
  }

  // méthode pour mettre à jour le commentaire d'un habitat
  public function updateComment($id, $commentaire)
  {
    try {
      $stmt = $this->pdo->prepare('UPDATE habitat SET commentaire_habitat = ? WHERE habitat_id = ?');
      return $stmt->execute([$commentaire, $id]);
    } catch (PDOException $e) {
      error_log("Update Comment Habitat Error: " . $e->getMessage());
      return false;  // Return false in case of error
    }
  }
}
