<?php

class Database {
    private $pdo;
    private $couchDB;

    public function __construct() {
        $this->connectMySQL();
        $this->connectCouchDB();
    }

    private function connectMySQL() {
        try {
            $this->pdo = new PDO(
                sprintf(
                    'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                    DB_ARCADIA_HOST,
                    DB_ARCADIA_PORT,
                    DB_ARCADIA_NAME
                ),
                DB_ARCADIA_USER,
                DB_ARCADIA_PASSWORD
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exception) {
            error_log('Erreur de connexion à la base de données MySQL : ' . $exception->getMessage());
            die('Erreur : ' . $exception->getMessage());
        }
    }

    private function connectCouchDB() {
        try {
            $username = getenv('DB_COUCHDB_USER');
            $password = getenv('DB_COUCHDB_PASSWORD');
            $host = getenv('DB_COUCHDB_HOST');
            $port = getenv('DB_COUCHDB_PORT');
            $database = getenv('DB_COUCHDB_NAME');

            // Construction de l'URL de connexion
            $url = sprintf('http://%s:%s@%s:%s/%s', $username, $password, $host, $port, $database);

            // Initialisation avec cURL pour communiquer avec CouchDB
            $this->couchDB = curl_init();
            curl_setopt($this->couchDB, CURLOPT_URL, $url);
            curl_setopt($this->couchDB, CURLOPT_RETURNTRANSFER, true);

        } catch (Exception $e) {
            error_log('Erreur de connexion à CouchDB : ' . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function getCouchDB() {
        return $this->couchDB;
    }

    // Ajoutez cette méthode
    public function getConnection() {
        return $this->getPDO();
    }
}