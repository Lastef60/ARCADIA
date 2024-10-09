<?php

require_once(__DIR__ . '/../models/Service.php');
require_once(__DIR__ . '/../models/Horaire.php');

class HomeController {
    private $serviceModel;
    private $horaireModel;

    public function __construct($pdo) {
        $this->serviceModel = new Service($pdo);
        $this->horaireModel = new Horaire($pdo);
    }

    public function index() {
        $services = $this->serviceModel->getAllServices();
        $horaires = $this->horaireModel->getAllHoraires();

        return ['services' => $services, 'horaires' => $horaires];
    }
}
