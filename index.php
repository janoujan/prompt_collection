<?php
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ . '/includes/db_connect.php';
?> 

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
    <h2>Bienvenue dans ta collection de prompt collaborative</h2>
    <h3>Invites tes potes à ajoutez et partager des prompts &#128293; &#128640; &#128165;</h3>
    <h4>Modifie supprime et mets en favoris tes prompts</h4>
    <p>Projet etudiant à but pédagogique</p>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
