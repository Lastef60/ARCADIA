<?php

class RapportVeterinaire {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer tous les rapports vétérinaires
    public function getAllRapports() {
        $stmt = $this->pdo->query("SELECT * FROM rapport_veterinaire");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouveau rapport vétérinaire
    public function addRapport($date, $detail, $animal_id, $etat_animal, $nourriture, $grammage) {
        $stmt = $this->pdo->prepare("INSERT INTO rapport_veterinaire (date, detail, animal_id, etat_animal, nourriture, grammage) VALUES (:date, :detail, :animal_id, :etat_animal, :nourriture, :grammage)");
        return $stmt->execute([
            'date' => $date,
            'detail' => $detail,
            'animal_id' => $animal_id,
            'etat_animal' => $etat_animal,
            'nourriture' => $nourriture,
            'grammage' => $grammage
        ]);
    }


}
