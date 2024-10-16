<?php
class Avis
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  // Méthode pour créer un nouvel avis (non validé)
  public function create($pseudo, $message)
  {
    $query = "INSERT INTO avis_temp (pseudo, message, isvisible, date_publication) VALUES (:pseudo, :message, 0, NOW())"; // 0 pour isvisible car non validé
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':message', $message);
    return $stmt->execute();
  }

  // Méthode pour récupérer tous les avis validés (isvisible = 1)
  public function readAll()
  {
    $query = "SELECT * FROM avis WHERE isvisible = 1 ORDER BY date_publication DESC";
    $stmt = $this->db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Méthode pour récupérer un avis spécifique par ID
  public function readById($id)
  {
    $query = "SELECT * FROM avis WHERE avis_id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Méthode pour mettre à jour un avis dans avis_temp (avant validation)
  public function update($id, $pseudo, $message)
  {
    $query = "UPDATE avis_temp SET pseudo = :pseudo, message = :message WHERE avis_id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':message', $message);
    return $stmt->execute();
  }

  // Méthode pour supprimer un avis de avis_temp (avant validation)
  public function delete($id)
  {
    $query = "DELETE FROM avis_temp WHERE avis_id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  // Méthode pour récupérer tous les avis non validés (isvisible = 0)
  public function readUnvalidated()
  {
    $query = "SELECT * FROM avis_temp WHERE isvisible = 0 ORDER BY date_publication DESC";
    $stmt = $this->db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Méthode pour valider un avis (le rendre visible en le déplaçant vers la table avis)
  public function validate($id)
  {
    // Récupérer l'avis dans avis_temp
    $query = "SELECT * FROM avis_temp WHERE avis_id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $avis = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($avis) {
      // Insérer l'avis dans la table avis
      $queryInsert = "INSERT INTO avis (pseudo, message, isvisible, date_publication) VALUES (:pseudo, :message, 1, :date_publication)";
      $stmtInsert = $this->db->prepare($queryInsert);
      $stmtInsert->bindParam(':pseudo', $avis['pseudo']);
      $stmtInsert->bindParam(':message', $avis['message']);
      $stmtInsert->bindParam(':date_publication', $avis['date_publication']);
      $stmtInsert->execute();

      // Supprimer l'avis de avis_temp
      $this->delete($id);
    }
  }
}
