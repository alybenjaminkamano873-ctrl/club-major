<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/EntrainementController.php';
require_once __DIR__ . '/../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entrainementController = new EntrainementController();
    $entrainementController->addEntrainement($_POST);
    header('Location: list.php');
    exit;
}
?>

<h2>Ajouter un Entraînement</h2>
<form method="POST">
    <input type="text" name="titre" placeholder="Titre" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="date" name="date" required>
    <input type="time" name="heure" required>
    <input type="text" name="lieu" placeholder="Lieu" required>
    <select name="type" required>
        <option value="endurance_fondamentale">Endurance fondamentale</option>
        <option value="fractionne">Fractionné</option>
        <option value="sortie_longue">Sortie longue</option>
        <option value="preparation_competition">Préparation compétition</option>
    </select>
    <input type="number" name="entraineur_id" placeholder="ID Entraîneur" required>
    <input type="text" name="groupe" placeholder="Groupe">
    <button type="submit">Ajouter</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>