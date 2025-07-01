<?php
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ . '/../includes/db_connect.php';
//affichage de l'header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Ajouter un nouveau contact</h1>
   <form action="traitement_contact.php" method="POST">
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" maxlength="50" required><br><br>
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" maxlength="50" required><br><br>
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" maxlength="100" required><br><br>
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" maxlength="1000" rows="6"></textarea><br><br>
        <button type="submit">Enregistrer le contact</button>
    </form>
</body>
</html>
