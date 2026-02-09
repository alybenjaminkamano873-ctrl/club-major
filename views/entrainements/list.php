<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/EntrainementController.php';
require_once __DIR__ . '/../../includes/header.php';

$entrainementController = new EntrainementController();
$entrainements = $entrainementController->listEntrainements();
?>

<h2>Liste des Entraînements</h2>
<a href="add.php">Ajouter un entraînement</a>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Lieu</th>
            <th>Type</th>
            <th>Groupe</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entrainements as $e): ?>
        <tr>
            <td><?php echo $e['titre']; ?></td>
            <td><?php echo $e['date']; ?></td>
            <td><?php echo $e['heure']; ?></td>
            <td><?php echo $e['lieu']; ?></td>
            <td><?php echo $e['type']; ?></td>
            <td><?php echo $e['groupe']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $e['id']; ?>">Modifier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>