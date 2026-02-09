<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/EvenementController.php';
require_once __DIR__ . '/../../includes/header.php';

$evenementController = new EvenementController();
$evenements = $evenementController->listEvenements();
?>

<h2>Liste des Événements</h2>
<a href="add.php">Ajouter un événement</a>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Lieu</th>
            <th>Type</th>
            <th>Max Participants</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($evenements as $e): ?>
        <tr>
            <td><?php echo $e['titre']; ?></td>
            <td><?php echo $e['date']; ?></td>
            <td><?php echo $e['heure']; ?></td>
            <td><?php echo $e['lieu']; ?></td>
            <td><?php echo $e['type']; ?></td>
            <td><?php echo $e['max_participants']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $e['id']; ?>">Modifier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?></content>
<parameter name="filePath">c:\xampp\htdocs\Major\views\evenements\list.php
