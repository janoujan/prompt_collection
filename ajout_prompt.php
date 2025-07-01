<?php
// Détection de l'environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    include 'config_local.php';
} else {
    include 'config_infinity.php';
}

// Récupération des types
$types = mysqli_query($conn, "SELECT id, nom FROM types");
// Récupération des outils
$outils = mysqli_query($conn, "SELECT id, nom FROM outils");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un prompt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Ajouter un nouveau prompt</h1>
    <form action="traitement_prompt.php" method="POST">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" required maxlength="100"><br><br>
        <label for="contenu">Contenu :</label><br>
        <textarea id="contenu" name="contenu" rows="6" required maxlength="1000"></textarea><br><br>
        <label for="type">Type :</label><br>
        <select id="type" name="id_type" required>
            <?php while ($type = mysqli_fetch_assoc($types)): ?>
                <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['nom']) ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <label for="outil">Outil (facultatif) :</label><br>
        <select id="outil" name="id_outil">
            <option value="">-- Aucun --</option>
            <?php while ($outil = mysqli_fetch_assoc($outils)): ?>
                <option value="<?= $outil['id'] ?>"><?= htmlspecialchars($outil['nom']) ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <label for="observation">Observation (facultatif) :</label><br>
        <textarea id="observation" name="observation" rows="3" maxlength="500"></textarea><br><br>
        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur" value="anonyme" maxlength="50"><br><br>
        <label>
            <input type="checkbox" name="favori" value="1"> Marquer comme favori
        </label><br><br>
        <button type="submit">Enregistrer le prompt</button>
    </form>
</body>
</html>
<?php
mysqli_close($conn);
?>
