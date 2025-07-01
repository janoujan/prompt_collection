<?php
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ ."/../includes/constants.php";
require_once __DIR__ . '/../includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Contact</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h1>Ajouter un nouveau contact</h1>
<form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/../helper/traitement_contact.php" method="post">
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
    <?php include '../includes/footer.php'; ?>
</body>
</html>
