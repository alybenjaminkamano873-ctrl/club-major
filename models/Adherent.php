<?php
require_once __DIR__ . '/../config/database.php';

class Adherent {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($user_id, $nom, $prenom, $date_naissance, $lieu_naissance, $tel, $email, $photo, $taille_tshirt, $statut_adhesion, $date_adhesion, $date_expiration) {
        $stmt = $this->pdo->prepare("INSERT INTO adherents (user_id, nom, prenom, date_naissance, lieu_naissance, tel, email, photo, taille_tshirt, statut_adhesion, date_adhesion, date_expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $nom, $prenom, $date_naissance, $lieu_naissance, $tel, $email, $photo, $taille_tshirt, $statut_adhesion, $date_adhesion, $date_expiration]);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM adherents WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM adherents WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM adherents");
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
        $stmt = $this->pdo->prepare("UPDATE adherents SET " . implode(', ', $fields) . " WHERE id = ?");
        return $stmt->execute($values);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM adherents WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getActive() {
        $stmt = $this->pdo->query("SELECT * FROM adherents WHERE statut_adhesion = 'actif'");
        return $stmt->fetchAll();
    }
}
?>