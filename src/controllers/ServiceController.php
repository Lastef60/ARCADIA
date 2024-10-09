
<?php
require_once(__DIR__ . '/../models/Service.php');

class ServiceController {
    private $serviceModel;

    public function __construct($pdo) {
        $this->serviceModel = new Service($pdo);
    }

    public function list() {
        return $this->serviceModel->getAllServices(); // Récupérer les services et les retourner
    }
}