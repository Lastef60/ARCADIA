<?php
class Avis {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($pseudo, $message) {
        $query = "INSERT INTO avis_temp (pseudo, message, isvisible, date_publication) VALUES (:pseudo, :message, 1, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT * FROM avis WHERE isvisible = 1 ORDER BY date_publication DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $query = "SELECT * FROM avis WHERE avis_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $pseudo, $message) {
        $query = "UPDATE avis_temp SET pseudo = :pseudo, message = :message WHERE avis_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM avis_temp WHERE avis_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
