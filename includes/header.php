<?php
// Détection de l'environnement (local ou en ligne)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    // Environnement local
    $base_url = '';
} else {
    // Environnement en ligne
    $base_url = dirname($_SERVER['SCRIPT_NAME'], 2);
}

// Définir le chemin de base pour les liens
$base_path = $base_url ? $base_url : '';

// Variable pour savoir si l'application est dans un sous-dossier
$script_path = dirname($_SERVER['SCRIPT_NAME']);
$path_parts = explode('/', trim($script_path, '/'));
$sub_folder = end($path_parts);

if ($sub_folder === 'prompt' || $sub_folder === 'pages') {
    $base_path = dirname($_SERVER['SCRIPT_NAME'], 1);
}

$page = basename($_SERVER['PHP_SELF']);
echo '
<nav>
  <ul>
    <li><a href="' . $base_path . 'index.php" ' . ($page === '/index.php' ? 'class="active"' : '') . '><img src="' . $base_path . 'assets/images/logo_prompt_collection.png" alt="logo" width="120px" height="120px"></a></li>
    <li><a href="' . $base_path . 'index.php" ' . ($page === '/index.php' ? 'class="active"' : '') . '>Accueil</a></li>
    <li><a href="' . $base_path . '/prompt_collection/prompt/ajout_prompt.php" ' . ($page === 'ajout_prompt.php' ? 'class="active"' : '') . '>Ajouter un prompt</a></li>
    <li><a href="' . $base_path . '/prompt/liste_prompts.php" ' . ($page === 'liste_prompts.php' ? 'class="active"' : '') . '>Liste des prompts</a></li>
    <li><a href="' . $base_path . '/pages/about.php" ' . ($page === 'about.php' ? 'class="active"' : '') . '>À propos</a></li>
    <li><a href="' . $base_path . '/pages/contact.php" ' . ($page === 'contact.php' ? 'class="active"' : '') . '>Contact</a></li>
  </ul>
</nav>';
?>

