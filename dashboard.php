<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/controllers/AdherentController.php';
require_once __DIR__ . '/controllers/EntrainementController.php';
require_once __DIR__ . '/controllers/PaiementController.php';
require_once __DIR__ . '/includes/header.php';

$adherentController = new AdherentController();
$entrainementController = new EntrainementController();
$paiementController = new PaiementController();

$stats = [
    'adherents' => count($adherentController->listAdherents()),
    'entrainements' => count($entrainementController->listEntrainements()),
    'recettes' => $paiementController->getTotalRecettes()
];
?>

<div class="dashboard">
    <div class="logo-container">
        <img src="https://via.placeholder.com/400x300?text=CLUB+MAJOR" alt="Logo MAJOR" class="dashboard-logo">
    </div>
    <h1>Tableau de bord</h1>
    <div class="stats">
        <div class="stat">Adhérents: <?php echo $stats['adherents']; ?></div>
        <div class="stat">Entraînements: <?php echo $stats['entrainements']; ?></div>
        <div class="stat">Recettes: <?php echo $stats['recettes']; ?> MAD</div>
    </div>
    <div class="menu">
        <a href="views/adherents/list.php">Gérer Adhérents</a>
        <a href="views/entrainements/list.php">Gérer Entraînements</a>
        <a href="views/evenements/list.php">Gérer Événements</a>
        <a href="views/paiements/list.php">Gérer Paiements</a>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>