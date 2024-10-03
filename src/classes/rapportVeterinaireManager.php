<?php
require_once('Database.php');
require_once('rapportVeterinaire.php');

class RapportVeterinaireManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterRapport($date, $detail, $etat_animal, $nourriture, $grammage, $prenom_animal) {
        $rapport = new RapportVeterinaire($this->pdo);
        return $rapport->ajouter($date, $detail, $etat_animal, $nourriture, $grammage, $prenom_animal);
    }
}
?>
