<?php
// Détection de l'environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    include '../includes/config_local.php';
} else {
    include '../includes/config_infinity.php';
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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h1>Ajouter un nouveau prompt</h1>
    <form action="../php/traitement_prompt.php" method="POST">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" maxlength="100" required><br><br>
        <label for="contenu">Contenu :</label><br>
        <textarea id="contenu" name="contenu" maxlength="1000" rows="6" required></textarea><br><br>
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
        <textarea id="observation" name="observation" maxlength="500" rows="3"></textarea><br><br>
        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur" maxlength="50" value="anonyme"><br><br>
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
