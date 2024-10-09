<?php

class Habitat
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  // CREATE - Ajouter un habitat
  public function create($nom, $description, $commentaire_habitat)
  {
    $stmt = $this->pdo->prepare('INSERT INTO habitat (nom, description, commentaire_habitat) VALUES (?, ?, ?)');
    return $stmt->execute([$nom, $description, $commentaire_habitat]);
  }

  // READ - Récupérer tous les habitats
  public function getAll()
  {
    $stmt = $this->pdo->query('SELECT * FROM habitat');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // READ - Récupérer un habitat par ID
  public function getById($id)
  {
    $stmt = $this->pdo->prepare('SELECT * FROM habitat WHERE habitat_id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // UPDATE - Modifier un habitat
  public function update($id, $nom, $description, $commentaire_habitat)
  {
    $stmt = $this->pdo->prepare('UPDATE habitat SET nom = ?, description = ?, commentaire_habitat = ? WHERE habitat_id = ?');
    return $stmt->execute([$nom, $description, $commentaire_habitat, $id]);
  }

  // DELETE - Supprimer un habitat
  public function delete($id)
  {
    $stmt = $this->pdo->prepare('DELETE FROM habitat WHERE habitat_id = ?');
    return $stmt->execute([$id]);
  }

  // méthode pour mettre à jour le commentaire d'un habitat
  public function updateComment($id, $commentaire)
  {
    $stmt = $this->pdo->prepare('UPDATE habitat SET commentaire_habitat = ? WHERE habitat_id = ?');
    return $stmt->execute([$commentaire, $id]);
  }
}
