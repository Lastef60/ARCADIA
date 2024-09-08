<?php

require_once(__DIR__ . '/functions.php');

$pdo = connexionBDD();
$avisVisiteurs = recupAvis();
//pr n'afficher que les 5 derniers avis :
$avisVisiteurs = array_slice($avisVisiteurs, -5);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZOO ARCADIA</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body id="js_index_page">
  <?php require_once(__DIR__ . '/header.php'); ?>

  <h1 class="animate__animated animate__wobble">BIENVENUE AU ZOO ARCADIA</h1>
  <div class="css_indexIntro">
    <p>
      Bienvenue au Zoo Arcadia, un véritable joyau écologique niché en Bretagne, au cœur de la légendaire
      forêt de Brocéliande, un lieu empreint de mystère et de magie.
      <img class="css_img_indexIntro" src="./uploads/img/jungle_tictac.jpg" alt="Jungle Tictac" />
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
      <img class="css_img_indexIntro" src="./uploads/img/jungle_hope.jpg" alt="Jungle Hope" />
      Enfin, laissez-vous envoûter par le marais mystérieux, un écosystème aquatique qui regorge de vie
      et de couleurs, offrant un aperçu fascinant de la faune des zones humides.
    </p>
    <p>
      Mais le Zoo Arcadia n'est pas seulement un lieu de découverte et d'émerveillement. Nous nous engageons
      également à jouer un rôle essentiel dans la conservation de la faune. Notre mission est de sensibiliser
      et d'éduquer les visiteurs de tous âges sur l'importance cruciale de protéger notre planète et ses habitants.
      <img class="css_img_indexIntro" src="./uploads/img/marais_bisco.jpg" alt="Marais Bisco" />
      À travers nos programmes éducatifs, nos expositions interactives et nos initiatives de conservation,
      nous cherchons à inspirer une prise de conscience et une action en faveur de la sauvegarde des espèces
      et des habitats naturels. Venez nous rendre visite et plongez dans un univers où chaque moment est une
      opportunité d'apprendre et de participer à la protection de notre précieuse planète.
    </p>
  </div>

  <h2>Nos habitats et nos animaux</h2>
  <p>Plongez dans une aventure véritablement inoubliable en explorant nos divers habitats fascinants – la jungle dense et luxuriante, la savane étendue et ensoleillée, ainsi que le marais mystérieux et verdoyant. Chaque zone offre une expérience unique, vous permettant de découvrir et d’observer de près une incroyable variété de faune dans des environnements naturels soigneusement recréés. Vous aurez l'occasion d'admirer les majestueux félins, les singes espiègles, les oiseaux exotiques, ainsi que d'autres créatures fascinantes qui habitent ces écosystèmes diversifiés. Que vous soyez un passionné de nature ou un visiteur curieux, chaque coin de notre zoo promet de vous émerveiller avec des rencontres animales captivantes et des moments mémorables. Venez vivre cette aventure immersive et laissez-vous transporter dans le monde merveilleux de la faune sauvage !</p>
  <div class="css_index_habitat">
    <div class="css_index_habitat_item">
      <img class="css_index_img_habitat flash js_habitat" src="./uploads/img/jungle_habitat.jpg" alt="Jungle" />
      <h3 class="css_index_h3">LA JUNGLE</h3>
    </div>

    <div class="css_index_habitat_item">
      <img class="css_index_img_habitat flash js_habitat" src="./uploads/img/savane_habitat.jpg" alt="Savane" />
      <h3 class="css_index_h3">LA SAVANE</h3>
    </div>

    <div class="css_index_habitat_item">
      <img class="css_index_img_habitat flash js_habitat" src="./uploads/img/marais_habitat.jpg" alt="Marais" />
      <h3 class="css_index_h3">LE MARAIS</h3>
    </div>
  </div>

  <p class="css_index_messageOver" id="js_commentaireHabitat">
    cliquez sur l'image pour découvrir les habitats et leurs animaux
  </p>


  <h2>Préparez votre visite pour la rendre inoubliable ...</h2>

  <p>
    Pour enrichir votre expérience et rendre votre visite encore plus agréable, nous vous invitons à explorer les nombreux avantages que nous proposons.
    Il vous suffit de cliquer sur les photos ci-dessous pour découvrir toutes les surprises et services supplémentaires que nous avons préparés spécialement pour vous.
  </p>

  <div class="css_galerie">
    <img class="js_services css_services train" src="./uploads/img/service_petitTrain.jpg" />
    <img class="js_services css_services resto1" src="./uploads/img/service_resto1.jpg" />
    <img class="js_services css_services resto2" src="./uploads/img/service_resto2.jpg" />
    <img class="js_services css_services resto3" src="./uploads/img/service_resto3.jpg" />
    <img class="js_services css_services visiteGuidee" src="./uploads/img/service_visiteGuidee.jpg" />
  </div>
  <h2>Ils sont venus nous voir ...</h2>

  <div class="container">
    <div class="carrousel_estompe">
      <?php
      if ($avisVisiteurs) {
        foreach ($avisVisiteurs as $avisVisiteur) {
          echo '<div class="estompe_diapo">'; // Div pour chaque diapositive avec la classe correcte
          echo '<p class="carrousel_estompe_p">' . htmlspecialchars($avisVisiteur['pseudo']) . '</p>';
          echo '<p class="carrousel_estompe_p">' . htmlspecialchars($avisVisiteur['commentaire']) . '</p>';
          // Reformatage de la date pour qu'elle soit en jjmmaaaa et non l'inverse
          $dateOriginale = $avisVisiteur['date_publication'];
          $dateFormatee = date('d/m/Y', strtotime($dateOriginale));
          echo '<p class="carrousel_estompe_p"><em>' . htmlspecialchars($dateFormatee) . '</em></p>';
          echo '</div>';
        }
      } else {
        echo '<p>Aucun avis pour le moment.</p>';
      }
      ?>
    </div>
  </div>

  <p class="css_p_avis_lien">Pour nous laisser votre avis <a href="contact.php">cliquez-ici.</a></p>

  <?php require_once(__DIR__ . '/footer.php'); ?>
  <script src="script.js"></script>
</body>

</html>