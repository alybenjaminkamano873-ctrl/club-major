<?php
require_once __DIR__ . '/../models/Adherent.php';
require_once __DIR__ . '/../models/Paiement.php';

class AdherentController {
    private $adherentModel;
    private $paiementModel;

    public function __construct() {
        $this->adherentModel = new Adherent();
        $this->paiementModel = new Paiement();
    }

    public function listAdherents() {
        return $this->adherentModel->getAll();
    }

    public function getAdherent($id) {
        return $this->adherentModel->findById($id);
    }

    public function addAdherent($data) {
        return $this->adherentModel->create($data['user_id'], $data['nom'], $data['prenom'], $data['date_naissance'], $data['lieu_naissance'], $data['tel'], $data['email'], $data['photo'], $data['taille_tshirt'], $data['statut_adhesion'], $data['date_adhesion'], $data['date_expiration']);
    }

    public function updateAdherent($id, $data) {
        return $this->adherentModel->update($id, $data);
    }

    public function deleteAdherent($id) {
        return $this->adherentModel->delete($id);
    }

    public function getPaiements($adherent_id) {
        return $this->paiementModel->getByAdherent($adherent_id);
    }

    public function exportAdherents() {
        $adherents = $this->adherentModel->getAll();
        // Simple CSV export
        $output = "ID,Nom,Prenom,Email,Statut\n";
        foreach ($adherents as $a) {
            $output .= "{$a['id']},{$a['nom']},{$a['prenom']},{$a['email']},{$a['statut_adhesion']}\n";
        }
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="adherents.csv"');
        echo $output;
    }
}
?>