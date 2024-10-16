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

    <h1 class="animate__animated animate__wobble">BIENVENUE AU ZOO ARCADIA</h1>
  <div class="css_indexIntro">
  <p>
    Bienvenue au Zoo Arcadia, un véritable joyau écologique niché en Bretagne, au cœur de la légendaire
    forêt de Brocéliande, un lieu empreint de mystère et de magie.
    <img class="css_img_indexIntro" src="../../public/uploads/img/jungle_tictac.jpg" alt="Jungle Tictac"/>
    Depuis sa création en 1960, le Zoo Arcadia, sous la direction passionnée et visionnaire de José,
    s'est engagé avec détermination dans la préservation des espèces menacées et la protection précieuse
    de la biodiversité. Nous avons à cœur de faire de notre zoo un sanctuaire où la faune trouve refuge
    et où chaque visiteur peut découvrir la beauté du monde animal dans des conditions respectueuses et naturelles.
    Le Zoo Arcadia vous invite à explorer trois habitats fascinants, chacun recréé avec soin pour offrir
    une immersion captivante dans des écosystèmes riches et variés.
  </p>
  <p>
    Vous pourrez vous promener à travers notre jungle luxuriante, où les arbres majestueux et la
    végétation dense abritent une faune vibrante et diversifiée. Ensuite, découvrez la savane étendue,
    un espace ouvert et ensoleillé qui reflète la grandeur des plaines africaines, avec ses habitants
    emblématiques comme les lions et les girafes.
    <img class="css_img_indexIntro" src="../../public/uploads/img/jungle_hope.jpg" alt="Jungle Hope"/>
    Enfin, laissez-vous envoûter par le marais mystérieux, un écosystème aquatique qui regorge de vie
    et de couleurs, offrant un aperçu fascinant de la faune des zones humides.
  </p>
  <p>
    Mais le Zoo Arcadia n'est pas seulement un lieu de découverte et d'émerveillement. Nous nous engageons
    également à jouer un rôle essentiel dans la conservation de la faune. Notre mission est de sensibiliser
    et d'éduquer les visiteurs de tous âges sur l'importance cruciale de protéger notre planète et ses habitants.
    <img class="css_img_indexIntro" src="../../public/uploads/img/marais_bisco.jpg" alt="Marais Bisco"/>
    À travers nos programmes éducatifs, nos expositions interactives et nos initiatives de conservation,
    nous cherchons à inspirer une prise de conscience et une action en faveur de la sauvegarde des espèces
    et des habitats naturels. Venez nous rendre visite et plongez dans un univers où chaque moment est une
    opportunité d'apprendre et de participer à la protection de notre précieuse planète.
  </p>
</div>

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
