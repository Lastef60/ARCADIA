<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Bienvenue José</h1>
  <?php require_once(__DIR__.'/header.php');?>
  <p>Veuillez selectionner votre tâche</p>

  <p>Pour ajouter des nouvelles photos à la base de donnée Arcadia, merci de
    <a class= js_admin_bddimg href="./upload.html">cliquez ici</a>
  </p>

  <p>Pour gerer les connexions de vos vétérinaires et vos employés, merci de 
    <a class= js_admin_bdduser href="./compteUtilisateur.html">cliquez ici</a>
  </p>

  <p>Afin de gerer les services proposez pour le zoo, merci de vous rendre sur cette page :
    <a class= js_admin_bddservice href="./compteService.php">page service</a>
  </p>

  <p>Afin de gerer les habitats du zoo, merci de vous rendre sur cette page :
    <a class= js_admin_bddhabitat href="./compteHabitat.html">page habitat</a>
  </p>

  <p>Afin de gerer les animaux présents dans le zoo, merci de vous rendre sur cette page :
    <a class= js_admin_bddanimal href="./compteAnimal.html">page animal</a>
  </p>
    
  <script src="script.js"></script>
</body>
</html>