<?php
// Détection de l'environnement (local ou InfinityFree)
require_once __DIR__ . '/../includes/db_connect.php';

// Récupération du mot-clé de recherche
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Récupération de l'auteur
$auteur = isset($_GET['auteur']) ? trim($_GET['auteur']) : '';

// Nombre de prompts par page
$prompts_per_page = 5;

// Récupération du numéro de page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $prompts_per_page;

// Requête SQL pour compter le nombre total de prompts
$count_sql = "SELECT COUNT(*) as total FROM prompts p JOIN types t ON p.id_type = t.id";
if (!empty($keyword)) {
    $count_sql .= " WHERE p.titre LIKE '%$keyword%' OR p.contenu LIKE '%$keyword%' OR t.nom LIKE '%$keyword%'";
}
$count_result = mysqli_query($conn, $count_sql);
$total_prompts = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_prompts / $prompts_per_page);

// Requête SQL avec jointures pour récupérer type et outil (si présent)
$sql = "
    SELECT p.*, t.nom AS type_nom, o.nom AS outil_nom
    FROM prompts p
    JOIN types t ON p.id_type = t.id
    LEFT JOIN outils o ON p.id_outil = o.id
";

if (!empty($keyword)) {
    $sql .= " WHERE p.titre LIKE '%$keyword%' OR p.contenu LIKE '%$keyword%' OR t.nom LIKE '%$keyword%'";
}

$sql .= " ORDER BY p.date_creation DESC LIMIT $offset, $prompts_per_page";
$result = mysqli_query($conn, $sql);

// Requête SQL pour récupérer les auteurs distincts
$auteurs_sql = "SELECT DISTINCT auteur FROM prompts ORDER BY auteur";
$auteurs_result = mysqli_query($conn, $auteurs_sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Prompts</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <h1>Liste des Prompts enregistrés</h1>
    <form method="GET" action="liste_prompts.php">
        <label for="keyword">Rechercher :</label>
        <input type="text" id="keyword" name="keyword" value="<?= htmlspecialchars($keyword) ?>">
        <label for="auteur">Auteur :</label>
        <select id="auteur" name="auteur">
            <option value="">Tous les auteurs</option>
            <?php while ($auteur_row = mysqli_fetch_assoc($auteurs_result)): ?>
                <option value="<?= htmlspecialchars($auteur_row['auteur']) ?>" <?= $auteur_row['auteur'] == $auteur ? 'selected' : '' ?>><?= htmlspecialchars($auteur_row['auteur']) ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Filtrer</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Type</th>
                <th>Outil</th>
                <th>Observation</th>
                <th>Auteur</th>
                <th>Date</th>
                <th>Favoris</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['titre']) ?></td>
                        <td><?= nl2br($row['contenu']) ?></td>
                        <td><?= htmlspecialchars($row['type_nom']) ?></td>
                        <td><?= htmlspecialchars($row['outil_nom'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['observation'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['auteur']) ?></td>
                        <td><?= $row['date_creation'] ?></td>
                        <td>
                            <span class="toggle-favori" data-id="<?= $row['id'] ?>" style="cursor:pointer">
                            <?= $row['favori'] ? '⭐' : '☆' ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit_prompt.php?id=<?= $row['id'] ?>">Modifier</a>
                        </td>
                        <td>
                          <form class="delete-form" action="../helper/delete_prompt.php" method="POST"
                              onsubmit="return confirm('Confirmer la suppression ?');">
                              <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <button type="submit" class="delete-btn" title="Supprimer">supprimer
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="trash-icon">
                                <path fill="currentColor"
                                 d="M268 416h24a12 12 0 0012-12V204a12 12 0 00-12-12h-24a12 12 0 00-12 12v200a12 12 0 0012 12zm-88 0h24a12 12 0 0012-12V204a12 12 0 00-12-12h-24a12 12 0 00-12 12v200a12 12 0 0012 12zm184-336h-72l-9.4-18.7A24 24 0 00360 48H88a24 24 0 00-21.6 13.3L57 80H8A8 8 0 000 88v16a8 8 0 008 8h16l21.2 339a48 48 0 0047.9 45h261.9a48 48 0 0047.9-45L424 112h16a8 8 0 008-8V88a8 8 0 00-8-8zM128 432a16 16 0 01-16-15.1L90.8 128h266.4L336 416a16 16 0 01-16 16H128z" />
                              </svg>
                            </button>
                          </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Aucun prompt enregistré.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="liste_prompts.php?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>&auteur=<?= urlencode($auteur) ?>">Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="liste_prompts.php?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>&auteur=<?= urlencode($auteur) ?>" <?= $i == $page ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="liste_prompts.php?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>&auteur=<?= urlencode($auteur) ?>">Suivant</a>
        <?php endif; ?>
    </div>

    <p><a href="ajout_prompt.php">Ajouter un nouveau prompt</a></p>
<!-- Script à la fin du fichier, qui écoute les clics sur les étoiles -->
    <script>
        document.querySelectorAll('.toggle-favori').forEach(elem => {
            elem.addEventListener('click', () => {
                const id = elem.dataset.id;
                fetch('../helper/toggle_favori_ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        elem.textContent = data.favori ? '⭐' : '☆';
                    } else {
                        alert("Erreur : " + data.error);
                    }
                })
                .catch(() => alert("Erreur de communication avec le serveur"));
            });
        });
    </script>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
<?php
mysqli_close($conn);
?>

