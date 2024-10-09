<?php
require_once(__DIR__ . '/../models/RapportVeterinaire.php');

class RapportVeterinaireController {
    private $rapportModel;

    public function __construct($pdo) {
        $this->rapportModel = new RapportVeterinaire($pdo);
    }

    // Liste des rapports vétérinaires
    public function list() {
        return $this->rapportModel->getAllRapports();
    }

    // Ajouter un rapport
    public function add($data) {
        return $this->rapportModel->addRapport(
            $data['date'],
            $data['detail'],
            $data['animal_id'],
            $data['etat_animal'],
            $data['nourriture'],
            $data['grammage']
        );
    }

}
