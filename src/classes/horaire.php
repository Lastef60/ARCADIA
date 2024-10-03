<?php

class Horaire {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getHoraires() {
        return $this->pdo->query("SELECT * FROM horaire")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateHoraire($id, $ouverture, $fermeture) {
        $stmt = $this->pdo->prepare("UPDATE horaire SET ouverture = ?, fermeture = ? WHERE id = ?");
        $stmt->execute([$ouverture, $fermeture, $id]);
    }
}
