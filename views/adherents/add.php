<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /Major/login.php');
    exit;
}

require_once __DIR__ . '/../../controllers/AdherentController.php';
require_once __DIR__ . '/../../controllers/UserController.php';
require_once __DIR__ . '/../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userController = new UserController();
    $userController->register($_POST['username'], $_POST['email'], $_POST['password'], 'member', $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['lieu_naissance'], $_POST['tel'], $_POST['photo'], $_POST['taille_tshirt']);
    header('Location: list.php');
    exit;
}
?>

<h2>Ajouter un Adhérent</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="date" name="date_naissance" required>
    <input type="text" name="lieu_naissance" placeholder="Lieu de naissance">
    <input type="tel" name="tel" placeholder="Téléphone">
    <input type="file" name="photo">
    <input type="text" name="taille_tshirt" placeholder="Taille T-shirt">
    <button type="submit">Ajouter</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>