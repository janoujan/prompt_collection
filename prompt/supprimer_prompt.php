<?php
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ . '/../includes/db_connect.php';

// Récupération de l'ID du prompt à supprimer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Préparation de la requête SQL pour supprimer le prompt
    $stmt = mysqli_prepare($conn, "DELETE FROM prompts WHERE id = ?");
    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "i", $id);
    // Exécution
    if (mysqli_stmt_execute($stmt)) {
        echo "Le prompt a bien été supprimé.<br>";
        echo '<a href="liste_prompts.php">Retour à la liste des prompts</a>';
    } else {
        echo "Erreur lors de la suppression : " . mysqli_stmt_error($stmt);
    }
    // Fermeture
    mysqli_stmt_close($stmt);
} else {
    echo "ID de prompt invalide.";
}

mysqli_close($conn);
?>
