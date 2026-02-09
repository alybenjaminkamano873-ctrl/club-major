<?php
require_once __DIR__ . '/../config/database.php';

class Evenement {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($titre, $description, $date, $heure, $lieu, $type, $max_participants) {
        $stmt = $this->pdo->prepare("INSERT INTO evenements (titre, description, date, heure, lieu, type, max_participants) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$titre, $description, $date, $heure, $lieu, $type, $max_participants]);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM evenements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM evenements ORDER BY date DESC");
        return $stmt->fetchAll();
    }

    public function getUpcoming() {
        $stmt = $this->pdo->prepare("SELECT * FROM evenements WHERE date >= CURDATE() ORDER BY date ASC");
        $stmt->execute();
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
        $stmt = $this->pdo->prepare("UPDATE evenements SET " . implode(', ', $fields) . " WHERE id = ?");
        return $stmt->execute($values);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM evenements WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getInscrits($id) {
        $stmt = $this->pdo->prepare("SELECT a.nom, a.prenom FROM inscriptions_evenements ie JOIN adherents a ON ie.adherent_id = a.id WHERE ie.evenement_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}
?>