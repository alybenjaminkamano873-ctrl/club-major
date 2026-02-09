<?php
require_once __DIR__ . '/../models/Evenement.php';

class EvenementController {
    private $evenementModel;

    public function __construct() {
        $this->evenementModel = new Evenement();
    }

    public function listEvenements() {
        return $this->evenementModel->getAll();
    }

    public function getEvenement($id) {
        return $this->evenementModel->findById($id);
    }

    public function addEvenement($data) {
        return $this->evenementModel->create($data['titre'], $data['description'], $data['date'], $data['heure'], $data['lieu'], $data['type'], $data['max_participants']);
    }

    public function updateEvenement($id, $data) {
        return $this->evenementModel->update($id, $data);
    }

    public function deleteEvenement($id) {
        return $this->evenementModel->delete($id);
    }

    public function getUpcoming() {
        return $this->evenementModel->getUpcoming();
    }

    public function getInscrits($id) {
        return $this->evenementModel->getInscrits($id);
    }

    public function inscrire($adherent_id, $evenement_id) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO inscriptions_evenements (adherent_id, evenement_id) VALUES (?, ?)");
        return $stmt->execute([$adherent_id, $evenement_id]);
    }
}
?>