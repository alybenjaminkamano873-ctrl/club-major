<?php
require_once __DIR__ . '/../config/database.php';

class Paiement {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($adherent_id, $montant, $type, $date_paiement, $statut, $reference) {
        $stmt = $this->pdo->prepare("INSERT INTO paiements (adherent_id, montant, type, date_paiement, statut, reference) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$adherent_id, $montant, $type, $date_paiement, $statut, $reference]);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM paiements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByAdherent($adherent_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM paiements WHERE adherent_id = ? ORDER BY date_paiement DESC");
        $stmt->execute([$adherent_id]);
        return $stmt->fetchAll();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM paiements ORDER BY date_paiement DESC");
        return $stmt->fetchAll();
    }

    public function update($id, $data) {
        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id;
        $stmt = $this->pdo->prepare("UPDATE paiements SET " . implode(', ', $fields) . " WHERE id = ?");
        return $stmt->execute($values);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM paiements WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getTotalRecettes() {
        $stmt = $this->pdo->query("SELECT SUM(montant) as total FROM paiements WHERE statut = 'paye'");
        return $stmt->fetch()['total'];
    }
}
?>