<?php
// Détection de l'environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    include 'config_local.php';
} else {
    include 'config_infinity.php';
}

// Sécurisation et récupération des données du formulaire
$prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
$nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

// Vérification des champs obligatoires
if ($prenom && $nom && $email) {
    // Préparation de la requête SQL avec les bons champs
    $stmt = mysqli_prepare($conn, "INSERT INTO contacts (prenom, nom, email, message) VALUES (?, ?, ?, ?)");
    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "ssss", $prenom, $nom, $email, $message);
    // Exécution
    if (mysqli_stmt_execute($stmt)) {
        echo "Le contact a bien été enregistré.<br>";
        echo '<a href="ajout_contact.php">Ajouter un autre contact</a> | ';
        echo '<a href="contacts.php">Voir les contacts</a>';
    } else {
        echo "Erreur à l'enregistrement : " . mysqli_stmt_error($stmt);
    }
    // Fermeture
    mysqli_stmt_close($stmt);
} else {
    echo "Veuillez remplir tous les champs obligatoires.";
}

mysqli_close($conn);
?>
