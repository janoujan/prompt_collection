<?php
$page = basename($_SERVER['PHP_SELF']);
echo '
<nav>
  <ul>
    <li><a href="index.php" ' . ($page === 'index.php' ? 'class="active"' : '') . '><img src="assets/images/logo_prompt_collection.png" alt="logo" width="120px" height="120px"></a></li>
    <li><a href="pages/index.php" ' . ($page === 'index.php' ? 'class="active"' : '') . '>Accueil</a></li>
    <li><a href="pages/ajout_prompt.php" ' . ($page === 'ajout_prompt.php' ? 'class="active"' : '') . '>Ajouter un prompt</a></li>
    <li><a href="pages/liste_prompts.php" ' . ($page === 'liste_prompts.php' ? 'class="active"' : '') . '>Liste des prompts</a></li>
    <li><a href="pages/about.php" ' . ($page === 'about.php' ? 'class="active"' : '') . '>À propos</a></li>
    <li><a href="pages/contact.php" ' . ($page === 'contact.php' ? 'class="active"' : '') . '>Contact</a></li>
  </ul>
</nav>';
?>

