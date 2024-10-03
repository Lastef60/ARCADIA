<?php

require_once(__DIR__ . '/../vendor/autoload.php'); // Charge les dépendances

class AnimalCompteur {
    private $collection;

    public function __construct($mongoClient) {
        $this->collection = $mongoClient->selectCollection('animal');
    }

    public function incrementConsultation($nom) {
        if (empty($nom)) {
            throw new Exception('Le nom de l\'animal est manquant.');
        }

        // Requête pour incrémenter le compteur de consultations
        $result = $this->collection->updateOne(
            ['nom' => $nom],
            ['$inc' => ['consultations' => 1]]
        );

        // Vérification
        if ($result->getModifiedCount() > 0) {
            return ['success' => true, 'message' => "Consultations incrémentées pour $nom"];
        } else {
            throw new Exception("Animal $nom non trouvé ou aucun changement effectué.");
        }
    }
}
