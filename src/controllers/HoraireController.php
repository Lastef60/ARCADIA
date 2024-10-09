<?php
require_once(__DIR__ . '/../models/Horaire.php');

class HoraireController {
    private $horaireModel;

    public function __construct($pdo) {
        $this->horaireModel = new Horaire($pdo);
    }

    public function list() {
        return $this->horaireModel->getAllHoraires();
    }

    public function add($jour, $ouverture, $fermeture) {
        $this->horaireModel->addHoraire($jour, $ouverture, $fermeture);
    }

    public function update($id, $jour, $ouverture, $fermeture) {
        $this->horaireModel->updateHoraire($id, $jour, $ouverture, $fermeture);
    }

    public function delete($id) {
        $this->horaireModel->deleteHoraire($id);
    }
}
