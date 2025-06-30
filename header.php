<?php
$page = basename($_SERVER['PHP_SELF']);
echo '
<nav>
  <ul>
    <li><a href="index.php" ' . ($page === 'index.php' ? 'class="active"' : '') . '><img src="logo_prompt_collection.png" alt="logo" width="120px" height="120px"></a></li>
    <li><a href="index.php" ' . ($page === 'index.php' ? 'class="active"' : '') . '>Accueil</a></li>
    <li><a href="ajout_prompt.php" ' . ($page === 'ajout_prompt.php' ? 'class="active"' : '') . '>Ajouter un prompt</a></li>
    <li><a href="liste_prompts.php" ' . ($page === 'liste_prompts.php' ? 'class="active"' : '') . '>Liste des prompts</a></li>
    <li><a href="contact.php" ' . ($page === 'contact.php' ? 'class="active"': '') . '>Contact</a></li>
    <li><a href="about.php" ' . ($page === 'about.php' ? 'class="active"' : '') . '>À propos</a></li>
  </ul>
</nav>';
?>
 