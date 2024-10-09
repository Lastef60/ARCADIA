<?php

require_once(__DIR__ . '/../models/Service.php');
require_once(__DIR__ . '/../models/Horaire.php');

class HomeController {
    private $serviceModel;
    private $horaireModel;

    public function __construct($pdo) {
        $this->serviceModel = new ServiceZoo($pdo);
        $this->horaireModel = new Horaire($pdo);
    }

    public function index() {
        $services = $this->serviceModel->getServices();
        $horaires = $this->horaireModel->getHoraires();

        return ['services' => $services, 'horaires' => $horaires];
    }
}
