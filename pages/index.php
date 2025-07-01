<!-- <?php
// Détection de l'environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    include 'includes/config_local.php';
} else {
    include 'includes/config_infinity.php';
}
?> -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

  <body>
    <?php include 'includes/header.php'; ?>
    <h1>Accueil</h1>
    <h2>Bienvenue dans cette collection de prompt</h2>
    <h3>Ajoutez des prompts &#128293; &#128640; &#128165;</h3>
    <p>Projet etudiant à but pédagogique</p>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
