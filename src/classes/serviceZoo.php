<?php

class ServiceZoo {
  private $pdo;

  public function __construct($pdo) {
      $this->pdo = $pdo;
  }

  public function getServices() {
      return $this->pdo->query("SELECT * FROM service")->fetchAll(PDO::FETCH_ASSOC);
  }

  public function createService($nom, $description) {
      $stmt = $this->pdo->prepare("INSERT INTO service (nom, description) VALUES (?, ?)");
      $stmt->execute([$nom, $description]);
  }

  public function updateService($id, $description) {
      $stmt = $this->pdo->prepare("UPDATE service SET description = ? WHERE service_id = ?");
      $stmt->execute([$description, $id]);
  }

  public function deleteService($id) {
      $stmt = $this->pdo->prepare("DELETE FROM service WHERE service_id = ?");
      $stmt->execute([$id]);
  }
}
