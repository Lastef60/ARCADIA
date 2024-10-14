<?php $baseUrl = '/src/views'; ?>

<div class="css_header_div">
  <img class="css_header_logo" src="/public/uploads/img/logoblack.png" alt="logo" />
  <button class="css_header_menu_button js_header_menu_button" aria-label="Ouvrir le menu">&#9776;</button>
  <nav class="css_header_div_nav js_header_div_nav">
    <a class="css_header_div_nav_a" href="<?php echo $baseUrl; ?>/accueil.php">Accueil</a>
    <a class="css_header_div_nav_a" href="<?php echo $baseUrl; ?>/habitat/list.php">Les habitats et leurs animaux</a>
    <a class="css_header_div_nav_a" href="<?php echo $baseUrl; ?>/services.php">Nos services</a>
    <a class="css_header_div_nav_a" href="<?php echo $baseUrl; ?>/avis/list.php">Votre avis nous intéresse</a>
    <a class="css_header_div_nav_a" href="<?php echo $baseUrl; ?>/login.php">Connexion</a>
  </nav>
</div>
