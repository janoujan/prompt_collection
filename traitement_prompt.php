<?php
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  include 'config_local.php';
} else {
  include 'config_infinity.php';
}

$titre = htmlspecialchars(trim($_POST['titre'] ?? ''));
$contenu = htmlspecialchars(trim($_POST['contenu'] ?? ''));
$id_type = intval($_POST['id_type'] ?? 0);
$id_outil = isset($_POST['id_outil']) && $_POST['id_outil'] !== '' ? intval($_POST['id_outil']) : null;
$observation = !empty(trim($_POST['observation'])) ? htmlspecialchars(trim($_POST['observation'])) : null;
$favori = isset($_POST['favori']) ? 1 : 0;
$auteur = htmlspecialchars(trim($_POST['auteur'] ?? 'anonyme'));

// Vérification des champs obligatoires
if ($titre && $contenu && $id_type) {
  // Préparation de la requête SQL avec les bons champs
  $stmt = mysqli_prepare($conn,
    "INSERT INTO prompts (titre, contenu, id_type, id_outil, observation, favori, auteur)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
  );
  // Liaison des paramètres
  mysqli_stmt_bind_param($stmt, "ssiisi", $titre, $contenu, $id_type, $id_outil, $observation, $favori, $auteur);
  // Exécution
  if (mysqli_stmt_execute($stmt)) {
    echo '<div class="confirmation">✅ Le prompt a bien été enregistré.</div>';
    echo '<a href="ajout_prompt.php">Ajouter un autre</a> | ';
    echo '<a href="liste_prompts.php">Voir les prompts</a>';
  } else {
    echo "❌ Erreur : " . mysqli_stmt_error($stmt);
  }
  // Fermeture
  mysqli_stmt_close($stmt);
} else {
  echo "⚠ Veuillez remplir les champs obligatoires.";
}
mysqli_close($conn);
