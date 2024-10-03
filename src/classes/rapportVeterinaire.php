<?php
class RapportVeterinaire {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouter($date, $detail, $etat_animal, $nourriture, $grammage, $prenom_animal) {
        $stmt = $this->pdo->prepare('SELECT animal_id FROM animal WHERE prenom = ?');
        $stmt->execute([$prenom_animal]);
        $animal = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$animal) {
            throw new Exception('Animal non trouvé avec le prénom donné.');
        }

        $animal_id = $animal['animal_id'];
        $stmt = $this->pdo->prepare('INSERT INTO rapport_veterinaire (date, detail, etat_animal, nourriture, grammage, animal_id) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$date, $detail, $etat_animal, $nourriture, $grammage, $animal_id]);
    }
}
