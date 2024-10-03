<?php
class Habitat {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function modifier($nom, $description, $commentaire_habitat, $nom_habitat) {
        $stmt = $this->pdo->prepare('SELECT habitat_id FROM habitat WHERE nom = ?');
        $stmt->execute([$nom_habitat]);
        $habitat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$habitat) {
            throw new Exception('habitat non trouvé avec le nom donné');
        }
        $habitat_id = $habitat['habitat_id'];
        $stmt = $this->pdo->prepare('UPDATE habitat SET nom = ?, description = ?, commentaire_habitat = ? WHERE habitat_id = ?');
        $stmt->execute([$nom, $description, $commentaire_habitat, $habitat_id]);
    }
}
?>
