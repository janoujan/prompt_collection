<?php
// Détection de l'environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    include 'config_local.php';
} else {
    include 'config_infinity.php';
}

// Récupération de l'ID du prompt à modifier
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupération des types
$types = mysqli_query($conn, "SELECT id, nom FROM types");
// Récupération des outils
$outils = mysqli_query($conn, "SELECT id, nom FROM outils");

// Récupération des données du prompt
$prompt = null;
if ($id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM prompts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $prompt = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un prompt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Modifier un prompt</h1>
    <?php if ($prompt): ?>
        <form action="traitement_edit_prompt.php" method="POST">
            <input type="hidden" name="id" value="<?= $prompt['id'] ?>">
            <label for="titre">Titre :</label><br>
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($prompt['titre']) ?>" required><br><br>
            <label for="contenu">Contenu :</label><br>
            <textarea id="contenu" name="contenu" rows="6" required><?= htmlspecialchars($prompt['contenu']) ?></textarea><br><br>
            <label for="type">Type :</label><br>
            <select id="type" name="id_type" required>
                <?php while ($type = mysqli_fetch_assoc($types)): ?>
                    <option value="<?= $type['id'] ?>" <?= $type['id'] == $prompt['id_type'] ? 'selected' : '' ?>><?= htmlspecialchars($type['nom']) ?></option>
                <?php endwhile; ?>
            </select><br><br>
            <label for="outil">Outil (facultatif) :</label><br>
            <select id="outil" name="id_outil">
                <option value="">-- Aucun --</option>
                <?php while ($outil = mysqli_fetch_assoc($outils)): ?>
                    <option value="<?= $outil['id'] ?>" <?= $outil['id'] == $prompt['id_outil'] ? 'selected' : '' ?>><?= htmlspecialchars($outil['nom']) ?></option>
                <?php endwhile; ?>
            </select><br><br>
            <label for="observation">Observation (facultatif) :</label><br>
            <textarea id="observation" name="observation" rows="3"><?= htmlspecialchars($prompt['observation']) ?></textarea><br><br>
            <label>
                <input type="checkbox" name="favori" value="1" <?= $prompt['favori'] ? 'checked' : '' ?>> Marquer comme favori
            </label><br><br>
            <button type="submit">Mettre à jour le prompt</button>
        </form>
    <?php else: ?>
        <p>Prompt non trouvé.</p>
    <?php endif; ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
