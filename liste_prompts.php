<?php
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  include 'config_local.php';
} else {
  include 'config_infinity.php';
}

$sql = "
  SELECT p.*, t.nom AS type_nom, o.nom AS outil_nom
  FROM prompts p
  JOIN types t ON p.id_type = t.id
  LEFT JOIN outils o ON p.id_outil = o.id
  ORDER BY p.date_creation DESC
";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Prompts</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <h1>Liste des Prompts</h1>
  <table border="1">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Type</th>
        <th>Outil</th>
        <th>Observation</th>
        <th>Favori</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= htmlspecialchars($row['titre']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['contenu'])) ?></td>
            <td><?= htmlspecialchars($row['type_nom']) ?></td>
            <td><?= $row['outil_nom'] ?? '—' ?></td>
            <td><?= $row['observation'] ?? '' ?></td>
            <td><?= $row['favori'] ? '⭐' : '' ?></td>
            <td><?= $row['date_creation'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7">Aucun prompt.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
  <p><a href="ajout_prompt.php">Ajouter un prompt</a></p>
</body>
</html>
<?php mysqli_close($conn); ?>
