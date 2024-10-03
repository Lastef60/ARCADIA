<?php
class Utilisateur {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter un utilisateur
    public function ajouter($username, $password, $nom, $prenom, $role_id) {
        if (empty($password)) {
            throw new Exception('Le mot de passe ne peut pas être vide.');
        }

        $hashed_password = hash('sha256', $password);
        $stmt = $this->pdo->prepare('INSERT INTO utilisateur (username, password, nom, prenom, role_id) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$username, $hashed_password, $nom, $prenom, $role_id]);
    }

    // Méthode pour supprimer un utilisateur
    public function supprimer($username) {
        if (empty($username)) {
            throw new Exception('Le nom d\'utilisateur ne peut pas être vide.');
        }

        $stmt = $this->pdo->prepare('DELETE FROM utilisateur WHERE username = ?');
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 0) {
            throw new Exception('Aucun utilisateur trouvé avec ce nom d\'utilisateur.');
        }
    }
}
