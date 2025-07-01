<?php 
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ . '/../includes/db_connect.php';
//affichage de l'header
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>À propos</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h1>À propos du projet</h1>

<p>Ce site a été réalisé dans le cadre d’un TP de développement web. Il permet de créer, classer et consulter des prompts pour différents outils d’intelligence artificielle comme ChatGPT, MidJourney, DALL·E, etc.</p>

<p>Objectifs pédagogiques :</p>
<ul>
  <li>Comprendre l’architecture web (HTML, PHP, MySQL)</li>
  <li>Travailler avec des relations entre tables (types, outils, prompts)</li>
  <li>Manipuler des formulaires et gérer les entrées utilisateur</li>
</ul>

<p>Projet réalisé par : <strong>Janou</strong></p>
<p>Contact : <a href="mailto:janou@janou.pro">janou@janou.pro</a></p>

<?php include '../includes/footer.php'; ?>
</body>
</html>
