<?php
require_once __DIR__ . '/../models/Paiement.php';

class PaiementController {
    private $paiementModel;

    public function __construct() {
        $this->paiementModel = new Paiement();
    }

    public function listPaiements() {
        return $this->paiementModel->getAll();
    }

    public function getPaiement($id) {
        return $this->paiementModel->findById($id);
    }

    public function addPaiement($data) {
        return $this->paiementModel->create($data['adherent_id'], $data['montant'], $data['type'], $data['date_paiement'], $data['statut'], $data['reference']);
    }

    public function updatePaiement($id, $data) {
        return $this->paiementModel->update($id, $data);
    }

    public function deletePaiement($id) {
        return $this->paiementModel->delete($id);
    }

    public function getByAdherent($adherent_id) {
        return $this->paiementModel->getByAdherent($adherent_id);
    }

    public function getTotalRecettes() {
        return $this->paiementModel->getTotalRecettes();
    }
}
?>