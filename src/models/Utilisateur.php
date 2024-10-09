<?php
class Utilisateur
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  // Récupérer un utilisateur par email
  public function getByEmail($email)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getAllUsers()
  {
    $stmt = $this->pdo->query("SELECT * FROM utilisateur");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function updateHoraires($id, $horaires)
  {
    $stmt = $this->pdo->prepare("UPDATE utilisateur SET horaires = :horaires WHERE utilisateur_id = :id");
    $stmt->execute(['horaires' => $horaires, 'id' => $id]);
  }

  public function deleteAvis($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM avis WHERE avis_id = :id");
    $stmt->execute(['id' => $id]);
  }

  public function validateAvis($id)
  {
    $stmt = $this->pdo->prepare("UPDATE avis SET valide = 1 WHERE avis_id = :id");
    $stmt->execute(['id' => $id]);
  }

  public function getAllAvis()
  {
    $stmt = $this->pdo->query("SELECT * FROM avis");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAllServices()
  {
    $stmt = $this->pdo->query("SELECT * FROM services");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
