<?php
require_once __DIR__ . '/../models/Entrainement.php';

class EntrainementController {
    private $entrainementModel;

    public function __construct() {
        $this->entrainementModel = new Entrainement();
    }

    public function listEntrainements() {
        return $this->entrainementModel->getAll();
    }

    public function getEntrainement($id) {
        return $this->entrainementModel->findById($id);
    }

    public function addEntrainement($data) {
        return $this->entrainementModel->create($data['titre'], $data['description'], $data['date'], $data['heure'], $data['lieu'], $data['type'], $data['entraineur_id'], $data['groupe']);
    }

    public function updateEntrainement($id, $data) {
        return $this->entrainementModel->update($id, $data);
    }

    public function deleteEntrainement($id) {
        return $this->entrainementModel->delete($id);
    }

    public function getUpcoming() {
        return $this->entrainementModel->getUpcoming();
    }

    public function getByCoach($coach_id) {
        return $this->entrainementModel->getByCoach($coach_id);
    }
}
?>