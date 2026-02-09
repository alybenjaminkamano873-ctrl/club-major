<?php
require_once __DIR__ . '/../config/database.php';

class Entrainement {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($titre, $description, $date, $heure, $lieu, $type, $entraineur_id, $groupe) {
        $stmt = $this->pdo->prepare("INSERT INTO entrainements (titre, description, date, heure, lieu, type, entraineur_id, groupe) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$titre, $description, $date, $heure, $lieu, $type, $entraineur_id, $groupe]);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM entrainements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM entrainements ORDER BY date DESC");
        return $stmt->fetchAll();
    }

    public function getUpcoming() {
        $stmt = $this->pdo->prepare("SELECT * FROM entrainements WHERE date >= CURDATE() ORDER BY date ASC");
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
        $stmt = $this->pdo->prepare("UPDATE entrainements SET " . implode(', ', $fields) . " WHERE id = ?");
        return $stmt->execute($values);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM entrainements WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByCoach($coach_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM entrainements WHERE entraineur_id = ? ORDER BY date DESC");
        $stmt->execute([$coach_id]);
        return $stmt->fetchAll();
    }
}
?>