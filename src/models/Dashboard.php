<?php
// models/Dashboard.php

class Dashboard {
    private $couchDB;

    public function __construct($couchDB) {
        $this->couchDB = $couchDB;
    }

    // Méthode pour obtenir les clics sur les animaux depuis CouchDB
    public function getClickCounts() {
        // URL pour récupérer tous les documents de la base CouchDB
        $url = "http://couchdb-stephaniet.alwaysdata.net:5984/stephaniet_arcadiacouchdb/_all_docs?include_docs=true";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Initialiser les données de clics
        $clickData = [
            'total_clicks' => 0,
            'details' => []
        ];

        if (isset($data['rows'])) {
            foreach ($data['rows'] as $row) {
                if (isset($row['doc']['consultations']) && isset($row['doc']['animal'])) {
                    $animalName = $row['doc']['animal'];
                    $consultations = $row['doc']['consultations'];

                    // Ajouter aux détails des clics
                    $clickData['details'][$animalName] = $consultations;
                    $clickData['total_clicks'] += $consultations;
                }
            }
        }

        return $clickData;
    }
}
