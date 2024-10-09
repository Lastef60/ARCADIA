<?php
require_once 'models/Avis.php';

class AvisController {
    private $avisModel;

    public function __construct($db) {
        $this->avisModel = new Avis($db);
    }

    public function create($pseudo, $message) {
        return $this->avisModel->create($pseudo, $message);
    }

    public function list() {
        return $this->avisModel->readAll();
    }

    public function show($id) {
        return $this->avisModel->readById($id);
    }

    public function update($id, $pseudo, $message) {
        return $this->avisModel->update($id, $pseudo, $message);
    }

    public function delete($id) {
        return $this->avisModel->delete($id);
    }
}
