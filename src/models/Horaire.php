<?php

class Horaire {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer tous les horaires
    public function getAllHoraires() {
        $stmt = $this->pdo->query("SELECT * FROM horaire");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouvel horaire
    public function addHoraire($jour, $ouverture, $fermeture) {
        $stmt = $this->pdo->prepare("INSERT INTO horaire (jour, ouverture, fermeture) VALUES (:jour, :ouverture, :fermeture)");
        $stmt->execute(['jour' => $jour, 'ouverture' => $ouverture, 'fermeture' => $fermeture]);
    }

    // Mettre à jour un horaire
    public function updateHoraire($id, $jour, $ouverture, $fermeture) {
        $stmt = $this->pdo->prepare("UPDATE horaire SET jour = :jour, ouverture = :ouverture, fermeture = :fermeture WHERE horaire_id = :id");
        $stmt->execute(['id' => $id, 'jour' => $jour, 'ouverture' => $ouverture, 'fermeture' => $fermeture]);
    }

    // Supprimer un horaire
    public function deleteHoraire($id) {
        $stmt = $this->pdo->prepare("DELETE FROM horaire WHERE horaire_id = :id");
        $stmt->execute(['id' => $id]);
    }
}
