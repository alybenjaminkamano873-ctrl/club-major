<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/EvenementController.php';
require_once __DIR__ . '/../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $evenementController = new EvenementController();
    $evenementController->addEvenement($_POST);
    header('Location: list.php');
    exit;
}
?>

<h2>Ajouter un Événement</h2>
<form method="POST">
    <input type="text" name="titre" placeholder="Titre" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="date" name="date" required>
    <input type="time" name="heure" required>
    <input type="text" name="lieu" placeholder="Lieu" required>
    <select name="type" required>
        <option value="course_officielle">Course officielle</option>
        <option value="competition">Compétition</option>
        <option value="seance_regroupement">Séance regroupement</option>
        <option value="sortie_running">Sortie running</option>
    </select>
    <input type="number" name="max_participants" placeholder="Max Participants">
    <button type="submit">Ajouter</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?></content>
<parameter name="filePath">c:\xampp\htdocs\Major\views\evenements\add.php
