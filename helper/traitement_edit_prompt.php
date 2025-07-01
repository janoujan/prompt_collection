<?php
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/constants.php';


// Sécurisation et récupération des données du formulaire
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$titre = htmlspecialchars(trim($_POST['titre'] ?? ''));
$contenu = htmlspecialchars(trim($_POST['contenu'] ?? ''));
$id_type = intval($_POST['id_type'] ?? 0);
$id_outil = isset($_POST['id_outil']) && $_POST['id_outil'] !== '' ? intval($_POST['id_outil']) : null;
$observation = !empty(trim($_POST['observation'])) ? htmlspecialchars(trim($_POST['observation'])) : null;
$favori = isset($_POST['favori']) ? 1 : 0;
$auteur = htmlspecialchars(trim($_POST['auteur'] ?? 'anonyme'));

// Vérification des champs obligatoires
if ($id > 0 && $titre && $contenu && $id_type) {
    // Préparation de la requête SQL avec les bons champs
    $stmt = mysqli_prepare($conn, "UPDATE prompts SET titre = ?, contenu = ?, id_type = ?, id_outil = ?, observation = ?, favori = ?, auteur = ? WHERE id = ?");
    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "ssiissii", $titre, $contenu, $id_type, $id_outil, $observation, $favori, $auteur, $id);
    // Exécution
    if (mysqli_stmt_execute($stmt)) {
        echo "Le prompt a bien été mis à jour.<br>";
        echo '<a href="../prompt/liste_prompts.php">Retour à la liste des prompts</a>';
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_stmt_error($stmt);
    }
    // Fermeture
    mysqli_stmt_close($stmt);
} else {
    echo "Veuillez remplir tous les champs obligatoires.";
}

mysqli_close($conn);
?>
