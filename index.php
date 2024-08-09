<?php

require_once(__DIR__.'/functions.php');

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
</head>
<body>
  <?php require_once(__DIR__.'/header.php');?>
 
  <h1>BIENVENUE AU ZOO ARCADIA</h1>

  <p>
  Bienvenue au Zoo Arcadia, un joyau écologique situé en Bretagne, au cœur de la légendaire forêt de Brocéliande. 
  Depuis sa création en 1960, sous la direction passionnée de José, notre zoo s'engage activement dans la préservation 
  des espèces et la protection de la biodiversité. Découvrez nos trois habitats fascinants  
  chacun offrant une immersion captivante dans des écosystèmes riches et variés. Le Zoo Arcadia n'est pas seulement un 
  lieu de découverte et d'émerveillement, mais aussi un acteur clé dans la conservation de la faune, 
  dédié à éduquer et à sensibiliser les visiteurs de tous âges à l'importance de la protection de notre planète.
  </p>

<h2>Nos habitats et nos animaux</h2>
<p>Plongez dans une aventure inoubliables à travers nos habitats – la savane, la jungle et le marais – et venez y decouvrir sa faune</p>

  <img class="css_img js_habitat" src="./uploads/img/jungle_habitat.jpg" />
  <p>LA JUNGLE</p>
  <img class="css_img js_habitat" src="./uploads/img/savane_habitat.jpg"/>
  <P>LA SAVANE</P>
  <img class="css_img js_habitat" src="./uploads/img/marais_habitat.jpg"/>
  <P>LE MARAIS</P>
  <p id="js_commentaireHabitat">cliquez sur l'image pour découvrir les habitats et leurs animaux</p>


<h2>Préparez votre visite pour la rendre inoubliable ...</h2>

<img class="js_services css_img" src="./uploads/img/service_petitTrain.jpg" />
<img class="js_services css_img" src="./uploads/img/service_resto1.jpg" />
<img class="js_services css_img" src="./uploads/img/service_resto2.jpg" />
<img class="js_services css_img" src="./uploads/img/service_resto3.jpg" />
<img class="js_services css_img" src="./uploads/img/service_visiteGuidee.jpg" />

<h2>Ils sont venus nous voir ...</h2>
<?php
  // affichage avis
  if ($avisVisiteurs) {
      foreach ($avisVisiteurs as $avisVisiteur) {
          echo '<div class="avis">';
          echo '<p>' . htmlspecialchars($avisVisiteur['pseudo']) . '</p>';
          echo '<p>' . htmlspecialchars($avisVisiteur['commentaire']) . '</p>';
          echo '<p><em>' . htmlspecialchars($avisVisiteur['date_publication']) . '</em></p>';
          echo '</div>';
      }
  } else {
      echo '<p>Aucun avis pour le moment.</p>';
  }
?>

  <?php require_once(__DIR__.'/footer.php');?>
  <script src="script.js"></script>
</body>
</html>
