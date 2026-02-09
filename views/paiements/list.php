<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/PaiementController.php';
require_once __DIR__ . '/../../includes/header.php';

$paiementController = new PaiementController();
$paiements = $paiementController->listPaiements();
?>

<h2>Liste des Paiements</h2>
<a href="add.php">Ajouter un paiement</a>
<table>
    <thead>
        <tr>
            <th>ID Adhérent</th>
            <th>Montant</th>
            <th>Type</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Référence</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($paiements as $p): ?>
        <tr>
            <td><?php echo $p['adherent_id']; ?></td>
            <td><?php echo $p['montant']; ?> MAD</td>
            <td><?php echo $p['type']; ?></td>
            <td><?php echo $p['date_paiement']; ?></td>
            <td><?php echo $p['statut']; ?></td>
            <td><?php echo $p['reference']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $p['id']; ?>">Modifier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?></content>
<parameter name="filePath">c:\xampp\htdocs\Major\views\paiements\list.php
