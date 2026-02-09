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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adherentController->updateAdherent($_GET['id'], $_POST);
    header('Location: list.php');
    exit;
}
?>

<h2>Modifier Adhérent</h2>
<form method="POST">
    <input type="text" name="nom" value="<?php echo $adherent['nom']; ?>" required>
    <input type="text" name="prenom" value="<?php echo $adherent['prenom']; ?>" required>
    <input type="date" name="date_naissance" value="<?php echo $adherent['date_naissance']; ?>">
    <input type="text" name="lieu_naissance" value="<?php echo $adherent['lieu_naissance']; ?>">
    <input type="tel" name="tel" value="<?php echo $adherent['tel']; ?>">
    <input type="email" name="email" value="<?php echo $adherent['email']; ?>">
    <input type="text" name="taille_tshirt" value="<?php echo $adherent['taille_tshirt']; ?>">
    <select name="statut_adhesion">
        <option value="actif" <?php if ($adherent['statut_adhesion'] == 'actif') echo 'selected'; ?>>Actif</option>
        <option value="expire" <?php if ($adherent['statut_adhesion'] == 'expire') echo 'selected'; ?>>Expiré</option>
        <option value="suspendu" <?php if ($adherent['statut_adhesion'] == 'suspendu') echo 'selected'; ?>>Suspendu</option>
    </select>
    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>