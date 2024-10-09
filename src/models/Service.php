<?php
class Service {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllServices() {
        $stmt = $this->pdo->query("SELECT * FROM service");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
