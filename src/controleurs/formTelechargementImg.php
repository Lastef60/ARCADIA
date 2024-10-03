<!--alimentation de la bdd mariadb ARCADIA table image, script pour permettre le telechargement des fichiers-->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>telechargement Image</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php require_once(__DIR__.'/header.php');?>

  <h1>page de telechargement des photos</h1>

  <form class="css_form" action="telechargementImg.php" method="post" enctype="multipart/form-data">
    <!--mettre dans action le nom du fichier qui va gerer le form-->
    <input type="file" name="image" accept="image/*" required>
    <input type="text" name="image_name" placeholder="Nom de l'image" required>
    <input type="submit" name="upload" value="Upload Image">
  </form>
  <script src="script.js"></script>
</body>

</html>