<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/PaiementController.php';
require_once __DIR__ . '/../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paiementController = new PaiementController();
    $paiementController->addPaiement($_POST);
    header('Location: list.php');
    exit;
}
?>

<h2>Ajouter un Paiement</h2>
<form method="POST">
    <input type="number" name="adherent_id" placeholder="ID Adhérent" required>
    <input type="number" step="0.01" name="montant" placeholder="Montant" required>
    <select name="type" required>
        <option value="cotisation_annuelle">Cotisation annuelle</option>
        <option value="cotisation_mensuelle">Cotisation mensuelle</option>
        <option value="evenement">Événement</option>
    </select>
    <input type="date" name="date_paiement">
    <select name="statut">
        <option value="paye">Payé</option>
        <option value="attente">En attente</option>
        <option value="retard">En retard</option>
    </select>
    <input type="text" name="reference" placeholder="Référence">
    <button type="submit">Ajouter</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?></content>
<parameter name="filePath">c:\xampp\htdocs\Major\views\paiements\add.php
