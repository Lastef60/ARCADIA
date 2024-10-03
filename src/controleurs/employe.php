<?php
require_once(__DIR__ . '/../core/functions.php'); // Chemin correct vers functions.php
$pdo = connexionBDD();

// Gestion des avis (valider/supprimer)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    $id = intval($_POST['id']); // Force conversion en entier

    // Vérification de l'ID
    if (empty($id)) {
        echo "Erreur : l'ID est manquant.";
        exit();
    } else {
        echo "ID reçu : " . htmlspecialchars($id);
    }

    if ($_POST['action'] === 'valider') {
        // Récupérer l'avis depuis la table temporaire
        $stmt = $pdo->prepare("SELECT * FROM avis_temp WHERE id = ?");
        $stmt->execute([$id]);
        $avis = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($avis) {
            // Insérer l'avis dans la table principale
            $stmt = $pdo->prepare("INSERT INTO avis (pseudo, commentaire, date_publication, isvisible) VALUES (?, ?, CURDATE(), 1)");
            $stmt->execute([$avis['pseudo'], $avis['message']]);

            // Supprimer l'avis de la table temporaire
            $stmt = $pdo->prepare("DELETE FROM avis_temp WHERE id = ?");
            $stmt->execute([$id]);
        }
    } elseif ($_POST['action'] === 'supprimer') {
        // Supprimer l'avis de la table temporaire
        $stmt = $pdo->prepare("DELETE FROM avis_temp WHERE id = ?");
        $stmt->execute([$id]);
    }
}

// Récupération des avis en attente
$avis = $pdo->query("SELECT * FROM avis_temp")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Employé</title>
    <link rel="stylesheet" href="../public/styles.css"> <!-- Corrige le chemin vers le CSS -->
</head>

<body>
    <?php require_once(__DIR__ . '/../views/header.php'); ?> <!-- Corrige le chemin vers header.php -->
    <h1>Bienvenue sur la page réservée aux employés</h1>

    <p>Depuis cette page vous pouvez gérer les services proposés par Arcadia et gérer les avis des visiteurs.</p>

    <p>Afin de gérer les services proposés pour le zoo, merci de vous rendre sur cette page :
        <a class="js_admin_bddservice" href="./compteService.php">page gestion des services</a>
    </p>

    <p>Merci de bien vouloir valider ou supprimer les avis en attente de validation.</p>

    <?php if ($avis): ?>
        <?php foreach ($avis as $avi): ?>
            <div>
                <p>Pseudo: <?= htmlspecialchars($avi['pseudo'] ?? 'Inconnu') ?></p>
                <p>Message: <?= htmlspecialchars($avi['message'] ?? 'Pas de message') ?></p>
                <p>ID de l'avis: <?= htmlspecialchars($avi['id']) ?></p>
                <form method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($avi['id']) ?>">
                    <button type="submit" name="action" value="valider">Valider</button>
                    <button type="submit" name="action" value="supprimer">Supprimer</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun avis en attente.</p>
    <?php endif; ?>

    <?php require_once(__DIR__ . '/../views/footer.php'); ?> <!-- Corrige le chemin vers footer.php -->
    <script src="../public/script.js"></script> <!-- Corrige le chemin vers le script -->
</body>

</html>
