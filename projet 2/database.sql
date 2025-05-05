
CREATE DATABASE IF NOT EXISTS newsletter;
USE newsletter;

CREATE TABLE comptes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255)
);
