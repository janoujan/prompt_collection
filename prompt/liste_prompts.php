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
                <th>Favori</th>
                <th>Auteur</th>
                <th>Date</th>
                <th>Actions</th>
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
                        <td><?= $row['favori'] ? '✓' : '' ?></td>
                        <td><?= htmlspecialchars($row['auteur']) ?></td>
                        <td><?= $row['date_creation'] ?></td>
                        <td>
                            <a href="edit_prompt.php?id=<?= $row['id'] ?>">Modifier</a> |
                            <a href="supprimer_prompt.php?id=<?= $row['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce prompt ?')">Supprimer</a>
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
</body>
</html>
<?php
mysqli_close($conn);
?>

