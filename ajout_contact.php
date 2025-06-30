<?php
// Détection de l'environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    include 'config_local.php';
} else {
    include 'config_infinity.php';
}
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
        <input type="text" id="prenom" name="prenom" required><br><br>
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="6"></textarea><br><br>
        <button type="submit">Enregistrer le contact</button>
    </form>
</body>
</html>
