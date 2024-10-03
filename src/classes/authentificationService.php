<?php

class AuthentificationService {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function authenticate($username, $password) {
        if (empty($username) || empty($password)) {
            throw new Exception("Nom d'utilisateur ou mot de passe manquant.");
        }

        $hashedPassword = hash('sha256', $password);

        $stmt = $this->pdo->prepare("
            SELECT r.label AS role, u.password 
            FROM utilisateur u
            JOIN role r ON u.role_id = r.role_id
            WHERE username = :username
        ");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $hashedPassword !== $user['password']) {
            throw new Exception("Nom d'utilisateur ou mot de passe incorrect");
        }

        return $user['role'];
    }
}
