<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/AdherentController.php';
require_once __DIR__ . '/../../includes/header.php';

$adherentController = new AdherentController();
$adherents = $adherentController->listAdherents();
?>

<h2>Liste des Adhérents</h2>
<a href="add.php">Ajouter un adhérent</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($adherents as $a): ?>
        <tr>
            <td><?php echo $a['id']; ?></td>
            <td><?php echo $a['nom']; ?></td>
            <td><?php echo $a['prenom']; ?></td>
            <td><?php echo $a['email']; ?></td>
            <td><?php echo $a['statut_adhesion']; ?></td>
            <td>
                <a href="profile.php?id=<?php echo $a['id']; ?>">Voir</a>
                <a href="edit.php?id=<?php echo $a['id']; ?>">Modifier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>