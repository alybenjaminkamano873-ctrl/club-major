-- Database schema for Club MAJOR

CREATE DATABASE IF NOT EXISTS major_db;
USE major_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'coach', 'member') NOT NULL DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Adherents table
CREATE TABLE IF NOT EXISTS adherents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    date_naissance DATE,
    lieu_naissance VARCHAR(100),
    tel VARCHAR(20),
    email VARCHAR(100),
    photo VARCHAR(255),
    taille_tshirt VARCHAR(10),
    statut_adhesion ENUM('actif', 'expire', 'suspendu') DEFAULT 'actif',
    date_adhesion DATE,
    date_expiration DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Entrainements table
CREATE TABLE IF NOT EXISTS entrainements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    heure TIME NOT NULL,
    lieu VARCHAR(100),
    type ENUM('endurance_fondamentale', 'fractionne', 'sortie_longue', 'preparation_competition') NOT NULL,
    entraineur_id INT,
    groupe VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (entraineur_id) REFERENCES users(id)
);

-- Evenements table
CREATE TABLE IF NOT EXISTS evenements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    heure TIME NOT NULL,
    lieu VARCHAR(100),
    type ENUM('course_officielle', 'competition', 'seance_regroupement', 'sortie_running') NOT NULL,
    max_participants INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inscriptions Entrainements
CREATE TABLE IF NOT EXISTS inscriptions_entrainements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adherent_id INT,
    entrainement_id INT,
    presence ENUM('oui', 'non') DEFAULT 'non',
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (adherent_id) REFERENCES adherents(id),
    FOREIGN KEY (entrainement_id) REFERENCES entrainements(id)
);

-- Inscriptions Evenements
CREATE TABLE IF NOT EXISTS inscriptions_evenements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adherent_id INT,
    evenement_id INT,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (adherent_id) REFERENCES adherents(id),
    FOREIGN KEY (evenement_id) REFERENCES evenements(id)
);

-- Paiements table
CREATE TABLE IF NOT EXISTS paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adherent_id INT,
    montant DECIMAL(10,2) NOT NULL,
    type ENUM('cotisation_annuelle', 'cotisation_mensuelle', 'evenement') NOT NULL,
    date_paiement DATE,
    statut ENUM('paye', 'attente', 'retard') DEFAULT 'attente',
    reference VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (adherent_id) REFERENCES adherents(id)
);

-- Annonces table for communication
CREATE TABLE IF NOT EXISTS annonces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    contenu TEXT,
    auteur_id INT,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES users(id)
);