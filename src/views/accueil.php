<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Zoo Arcadia</title>
    <link rel="stylesheet" href="../../public/styles.css">
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?>

    <h1>Bienvenue au Zoo Arcadia</h1>

    <p>
        Bienvenue au Zoo Arcadia, un joyau écologique situé en Bretagne, au cœur de la légendaire forêt de Brocéliande.
        Depuis sa création en 1960, sous la direction passionnée de José, notre zoo s'engage activement dans la préservation
        des espèces et la protection de la biodiversité. Découvrez nos trois habitats fascinants,
        chacun offrant une immersion captivante dans des écosystèmes riches et variés. Le Zoo Arcadia n'est pas seulement un
        lieu de découverte et d'émerveillement, mais aussi un acteur clé dans la conservation de la faune,
        dédié à éduquer et à sensibiliser les visiteurs de tous âges à l'importance de la protection de notre planète.
    </p>

    <h2>Nos habitats et nos animaux</h2>
    <p>Plongez dans une aventure inoubliable à travers nos habitats – la jungle, la savane et le marais – et venez y découvrir sa faune</p>
    <div class="css_index_habitatTitre">
        <h3 class="css_index_h3">LA JUNGLE</h3>
        <h3 class="css_index_h3">LA SAVANE</h3>
        <h3 class="css_index_h3">LE MARAIS</h3>
    </div>
    <div class="css_index_habitatImg">
        <img class="css_img js_habitat" src="../public/uploads/img/jungle_habitat.jpg" alt="Habitat Jungle" />
        <img class="css_img js_habitat" src="../public/uploads/img/savane_habitat.jpg" alt="Habitat Savane" />
        <img class="css_img js_habitat" src="../public/uploads/img/marais_habitat.jpg" alt="Habitat Marais" />
    </div>
    <p class="css_index_messageOver" id="js_commentaireHabitat">Cliquez sur l'image pour découvrir les habitats et leurs animaux</p>

    <h2>Préparez votre visite pour la rendre inoubliable ...</h2>
    <div class="css_services_container">
        <img class="js_services css_img" src="../public/uploads/img/service_petitTrain.jpg" alt="Petit Train" />
        <img class="js_services css_img" src="../public/uploads/img/service_resto1.jpg" alt="Restauration" />
        <img class="js_services css_img" src="../public/uploads/img/service_resto2.jpg" alt="Restauration" />
        <img class="js_services css_img" src="../public/uploads/img/service_resto3.jpg" alt="Restauration" />
        <img class="js_services css_img" src="../public/uploads/img/service_visiteGuidee.jpg" alt="Visite Guidée" />
    </div>

    <h2>Ils sont venus nous voir ...</h2>
    <div class="css_avis_container">
        <?php if ($avisVisiteurs): ?>
            <?php foreach ($avisVisiteurs as $avisVisiteur): ?>
                <div class="avis">
                    <p><?= htmlspecialchars($avisVisiteur['pseudo'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><?= htmlspecialchars($avisVisiteur['commentaire'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><em><?= htmlspecialchars($avisVisiteur['date_publication'], ENT_QUOTES, 'UTF-8') ?></em></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun avis pour le moment.</p>
        <?php endif; ?>
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
    <script src="../../public/script.js"></script>
</body>
</html>
