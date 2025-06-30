<!-- <!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Formulaire de contact</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <h1>Formulaire de contact</h1>
    <form action="form.php" method="POST">
      <label>Prénom :</label><br />
      <input type="text" name="prenom" required /><br /><br />
      <label>Nom :</label><br />
      <input type="text" name="nom" required /><br /><br />
      <label>Email :</label><br />
      <input type="email" name="email" required /><br /><br />
      <label>Message :</label><br />
      <textarea name="message"></textarea><br /><br />
      <button type="submit">Envoyer</button>
    </form>
  </body>
</html> -->

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Formulaire de contact</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <?php include 'header.php'; ?>
    <h1>Accueil</h1>
    <h2>Bienvenue dans cette collection de prompt</h2>
    <h3>Ajoutez des prompts &#128293; &#128640; &#128165;</h3>
    <p>Projet etudiant à but pédagogique</p>
    <?php include 'footer.php'; ?>
  </body>
</html>
