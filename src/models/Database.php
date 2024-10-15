<?php
require_once __DIR__ . '/../../vendor/autoload.php'; 

use PHPOnCouch\CouchClient;

class Database {
    private $couchClient;
    private $pdo;  // For MariaDB/MySQL connection

    public function __construct() {
        // CouchDB Configuration
        $couchHost = getenv('COUCHDB_HOST');
        $couchDbName = getenv('COUCHDB_DB');
        $couchUsername = getenv('COUCHDB_USER');
        $couchPassword = getenv('COUCHDB_PASSWORD');

        // Debugging: Log the variables to check their values
        error_log("CouchDB Config: Host: $couchHost, DB Name: $couchDbName, User: $couchUsername");

        // Initialize CouchDB Client
        $couchDsn = "http://$couchUsername:$couchPassword@$couchHost";
        $this->couchClient = new CouchClient($couchDsn, $couchDbName);

        // MariaDB Configuration
        $mariaDbHost = getenv('DB_ARCADIA_HOST');         // MariaDB host
        $mariaDbName = getenv('DB_ARCADIA_NAME');         // Database name
        $mariaDbUser = getenv('DB_ARCADIA_USER');         // Username for MariaDB
        $mariaDbPassword = getenv('DB_ARCADIA_PASSWORD'); // Password for MariaDB

        // Debugging: Log the MariaDB variables
        error_log("MariaDB Config: Host: $mariaDbHost, DB Name: $mariaDbName, User: $mariaDbUser");

        // Initialize PDO for MariaDB/MySQL connection
        try {
            $mariaDsn = "mysql:host=$mariaDbHost;dbname=$mariaDbName;charset=utf8";
            $this->pdo = new PDO($mariaDsn, $mariaDbUser, $mariaDbPassword, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            // Test connection
            $this->testConnection();
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            die("Database connection error.");
        }
    }

    // Return CouchDB client
    public function getCouchClient() {
        return $this->couchClient;
    }

    // Return PDO connection for MariaDB
    public function getPdo() {
        return $this->pdo;
    }

    // Test database connection
    private function testConnection() {
        try {
            $stmt = $this->pdo->query('SELECT 1');
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Test Query Error: " . $e->getMessage());
            return false;
        }
    }
}
