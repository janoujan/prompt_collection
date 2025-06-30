<?php
include 'config_local.php'; // ou config_infinity.php
$types = mysqli_query($conn, "SELECT id, nom FROM types");
$outils = mysqli_query($conn, "SELECT id, nom FROM outils");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un prompt</title>
</head>
<body>
  <h1>Ajouter un prompt</h1>
  <form action="traitement_prompt.php" method="POST">
    <label>Titre :</label><br>
    <input type="text" name="titre" required><br><br>

    <label>Contenu :</label><br>
    <textarea name="contenu" rows="6" required></textarea><br><br>

    <label>Type :</label><br>
    <select name="id_type" required>
      <?php while ($type = mysqli_fetch_assoc($types)): ?>
        <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['nom']) ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label>Outil (facultatif) :</label><br>
    <select name="id_outil">
      <option value="">-- Aucun --</option>
      <?php while ($outil = mysqli_fetch_assoc($outils)): ?>
        <option value="<?= $outil['id'] ?>"><?= htmlspecialchars($outil['nom']) ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label>Observation :</label><br>
    <textarea name="observation" rows="3"></textarea><br><br>

    <label><input type="checkbox" name="favori" value="1"> Favori</label><br><br>

    <button type="submit">Enregistrer</button>
  </form>
</body>
</html>
