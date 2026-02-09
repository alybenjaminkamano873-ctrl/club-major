<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Adherent.php';

class UserController {
    private $userModel;
    private $adherentModel;

    public function __construct() {
        $this->userModel = new User();
        $this->adherentModel = new Adherent();
    }

    public function login($email, $password) {
        $user = $this->userModel->authenticate($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function register($username, $email, $password, $role, $nom, $prenom, $date_naissance, $lieu_naissance, $tel, $photo, $taille_tshirt) {
        $this->userModel->create($username, $email, $password, $role);
        $user = $this->userModel->findByEmail($email);
        $this->adherentModel->create($user['id'], $nom, $prenom, $date_naissance, $lieu_naissance, $tel, $email, $photo, $taille_tshirt, 'actif', date('Y-m-d'), date('Y-m-d', strtotime('+1 year')));
    }

    public function getProfile($user_id) {
        $user = $this->userModel->findById($user_id);
        $adherent = $this->adherentModel->findByUserId($user_id);
        return ['user' => $user, 'adherent' => $adherent];
    }

    public function updateProfile($user_id, $data) {
        $this->userModel->update($user_id, $data['user']);
        $this->adherentModel->update($data['adherent']['id'], $data['adherent']);
    }

    public function listUsers() {
        return $this->userModel->getAll();
    }

    public function deleteUser($id) {
        $this->userModel->delete($id);
    }
}
?>