<?php
class Avis {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterAvis($pseudo, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO avis_temp (pseudo, message, isvisible) VALUES (?, ?, 0)");
        return $stmt->execute([$pseudo, $message]);
    }

    public function validerAvis($avis_id) {
        $stmt = $this->pdo->prepare("UPDATE avis SET isvisible = 1 WHERE avis_id = ?");
        return $stmt->execute([$avis_id]);
    }

    public function supprimerAvis($avis_id) {
        $stmt = $this->pdo->prepare("DELETE FROM avis WHERE avis_id = ?");
        return $stmt->execute([$avis_id]);
    }
}
?>
