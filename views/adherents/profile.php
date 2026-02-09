<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/AdherentController.php';
require_once __DIR__ . '/../../includes/header.php';

$adherentController = new AdherentController();
$adherent = $adherentController->getAdherent($_GET['id']);
$paiements = $adherentController->getPaiements($_GET['id']);
?>

<h2>Profil de <?php echo $adherent['prenom'] . ' ' . $adherent['nom']; ?></h2>
<p>Email: <?php echo $adherent['email']; ?></p>
<p>Statut: <?php echo $adherent['statut_adhesion']; ?></p>
<p>Date d'adhésion: <?php echo $adherent['date_adhesion']; ?></p>

<h3>Paiements</h3>
<table>
    <thead>
        <tr>
            <th>Montant</th>
            <th>Type</th>
            <th>Date</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($paiements as $p): ?>
        <tr>
            <td><?php echo $p['montant']; ?> MAD</td>
            <td><?php echo $p['type']; ?></td>
            <td><?php echo $p['date_paiement']; ?></td>
            <td><?php echo $p['statut']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>