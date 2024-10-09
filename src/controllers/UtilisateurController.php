<?php
require_once(__DIR__ . '/../models/Utilisateur.php');

class UtilisateurController
{
  private $utilisateurModel;

  public function __construct($pdo)
  {
    $this->utilisateurModel = new Utilisateur($pdo);
  }

  public function login($email, $password)
  {
    // Vérifier si l'utilisateur existe avec l'email donné
    $utilisateur = $this->utilisateurModel->getByEmail($email);

    if ($utilisateur) {
      // Vérifier le mot de passe (assurez-vous que le mot de passe est haché dans la base de données)
      if (password_verify($password, $utilisateur['mot_de_passe'])) {
        // Authentification réussie
        session_start();
        $_SESSION['utilisateur_id'] = $utilisateur['utilisateur_id'];
        $_SESSION['role_id'] = $utilisateur['role_id'];

        // Redirection selon le rôle
        switch ($utilisateur['role_id']) {
          case 1: // Admin
            header('Location: /src/views/admin/dashboard.php'); // Remplacez par le chemin correct
            exit();
          case 2: // Vétérinaire
            header('Location: /src/views/veterinaire/dashboard.php'); // Remplacez par le chemin correct
            exit();
          case 3: // Employé
            header('Location: /src/views/employe/dashboard.php'); // Remplacez par le chemin correct
            exit();
          default:
            // Redirection par défaut ou message d'erreur
            return "Rôle non reconnu.";
        }
      } else {
        return "Mot de passe incorrect.";
      }
    } else {
      return "Aucun utilisateur trouvé avec cet email.";
    }
  }
}
