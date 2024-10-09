<?php
// DashboardController.php

require_once(__DIR__ . '/../models/Dashboard.php');



class DashboardController {
    private $couchDB;
    private $dashboardModel;

    public function __construct($couchDB, $pdo) {
        $this->couchDB = $couchDB;
        $this->dashboardModel = new Dashboard($pdo);
    }

    // Méthode pour obtenir le nombre de clics pour un animal spécifique depuis CouchDB
    public function getAnimalClickCount($animalId) {
      

        // URL de la base de données CouchDB pour l'animal spécifique
        $url = "http://couchdb-stephaniet.alwaysdata.net:5984/stephaniet_arcadiacouchdb/$animalId";
        $response = file_get_contents($url);
        $animalData = json_decode($response, true);

        // Vérifie si les données de l'animal existent et retourne le nombre de consultations
        if (isset($animalData['consultations'])) {
            return $animalData['consultations']; // Retourne le compteur de consultations
        }

        return 0; // Retourne 0 si l'animal n'est pas trouvé
    }

    // Méthode pour incrémenter le compteur de clics d'un animal dans CouchDB
    public function incrementAnimalClickCount($animalId) {
        // Récupérer les données de l'animal depuis CouchDB
        $animalUrl = "http://couchdb-stephaniet.alwaysdata.net:5984/stephaniet_arcadiacouchdb/$animalId";
        $animalData = json_decode(file_get_contents($animalUrl), true);

        if (isset($animalData['_id']) && isset($animalData['_rev']) && isset($animalData['consultations'])) {
            $animalData['consultations'] += 1; // Incrémente le compteur de consultations

            // Mettre à jour l'animal dans CouchDB
            $updateUrl = "http://couchdb-stephaniet.alwaysdata.net:5984/stephaniet_arcadiacouchdb/" . $animalData['_id'];
            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n" .
                                 "Accept: application/json\r\n",
                    'method'  => 'PUT',
                    'content' => json_encode($animalData)
                ]
            ];
            $context  = stream_context_create($options);
            file_get_contents($updateUrl, false, $context);
        }
    }

    // Méthode pour obtenir les données de clics pour tous les animaux via le modèle Dashboard
    public function getClickData() {
        return $this->dashboardModel->getClickCounts();
    }
}
