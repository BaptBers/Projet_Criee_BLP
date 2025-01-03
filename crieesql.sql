DROP DATABASE IF EXISTS PROJET_CRIEE;
CREATE DATABASE PROJET_CRIEE;
USE PROJET_CRIEE;

-- Table BATEAU
CREATE TABLE BATEAU (
    IdBateau INT PRIMARY KEY,
    nomBateau VARCHAR(255) NOT NULL,
    capaciteBateau DECIMAL(10, 2) NOT NULL
);

-- Table ESPECE
CREATE TABLE ESPECE (
    IdEspece INT PRIMARY KEY,
    nomScientifique VARCHAR(255) NOT NULL,
    nomCommun VARCHAR(255) NOT NULL
);

-- Table PRESENTATION
CREATE TABLE PRESENTATION (
    IdPresentation INT PRIMARY KEY,
    descriptionPresentation VARCHAR(255) NOT NULL
);

-- Table TAILLE
CREATE TABLE TAILLE (
    IdTaille INT PRIMARY KEY,
    descriptionTaille VARCHAR(255) NOT NULL
);

-- Table QUALITE
CREATE TABLE QUALITE (
    IdQualite INT PRIMARY KEY,
    descriptionQualite VARCHAR(255) NOT NULL
);

-- Table BAC
CREATE TABLE BAC (
    IdBac INT PRIMARY KEY,
    tare DECIMAL(10, 2) NOT NULL
);

-- Table ACHETEUR
CREATE TABLE ACHETEUR (
    IdAcheteur INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    pwd VARCHAR(50) NOT NULL,
    raisonSocialeEntreprise VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    codePostal VARCHAR(5) NOT NULL,
    numHabilitation VARCHAR(50) 
);

-- Table ADMINISTRATEUR
CREATE TABLE ADMINISTRATEUR (
    IdAdmin INT AUTO_INCREMENT PRIMARY KEY,
    loginAdmin VARCHAR(50) NOT NULL UNIQUE,
    pwdAdmin VARCHAR(50) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL
);

-- Table IMAGE
CREATE TABLE IMAGE (
    IdImage INT AUTO_INCREMENT PRIMARY KEY,
    ImageLot VARCHAR(255) NOT NULL
    
);

-- Table FACTURE
CREATE TABLE FACTURE (
    IdFacture INT PRIMARY KEY,
    dateEmission DATE NOT NULL,
    montantTotal DECIMAL(10, 2) NOT NULL,
    IdAcheteur INT NOT NULL,
    FOREIGN KEY (IdAcheteur) REFERENCES ACHETEUR(IdAcheteur)
);

-- Table LOT
CREATE TABLE LOT (
    IdLot INT NOT NULL,
    IdBateau INT NOT NULL,
    datePeche DATE NOT NULL,
    IdEspece INT NOT NULL,
    IdTaille INT NOT NULL,
    IdPresentation INT NOT NULL,
    IdBac INT NOT NULL,
    IdAcheteur INT,
    IdQualite INT NOT NULL,
    idImage INT NOT NULL,
    poidsBrutLot DECIMAL(10, 2) NOT NULL,
    prixDepart DECIMAL(10, 2) NOT NULL,
    prixEnchereActuelle DECIMAL(10, 2) NOT NULL,
    dateOuverture DATE,
    dateFin DATE,
    heureOuverture TIME,
    heureFin TIME,
    statut VARCHAR(50),
    IdFacture INT,
    IdAdmin INT NOT NULL, 
    FOREIGN KEY (IdAdmin) REFERENCES ADMINISTRATEUR(IdAdmin),
    FOREIGN KEY (idImage) REFERENCES IMAGE(IdImage),
    PRIMARY KEY (IdLot),
    FOREIGN KEY (IdBateau) REFERENCES BATEAU(IdBateau),
    FOREIGN KEY (IdEspece) REFERENCES ESPECE(IdEspece),
    FOREIGN KEY (IdBateau, datePeche) REFERENCES PECHE(IdBateau, datePeche),
    FOREIGN KEY (IdTaille) REFERENCES TAILLE(IdTaille),
    FOREIGN KEY (IdPresentation) REFERENCES PRESENTATION(IdPresentation),
    FOREIGN KEY (IdBac) REFERENCES BAC(IdBac),
    FOREIGN KEY (IdAcheteur) REFERENCES HISTORIQUE_ENCHERES(IdAcheteur),
    FOREIGN KEY (IdQualite) REFERENCES QUALITE(IdQualite)
);

CREATE TABLE HISTORIQUE_ENCHERES(
    IdLot INT NOT NULL,
    IdAcheteur INT NOT NULL,
    montantEnchere DECIMAL(10, 2) NOT NULL,
    dateEnchere DATETIME,
    PRIMARY KEY (IdLot, IdAcheteur, dateEnchere),
    FOREIGN KEY (IdAcheteur) REFERENCES ACHETEUR(IdAcheteur),
    FOREIGN KEY (IdLot) REFERENCES LOT(IdLot)
);

CREATE TABLE PANIER (
    IdPanier INT AUTO_INCREMENT PRIMARY KEY,
    IdLot INT NOT NULL,
    IdAcheteur INT NOT NULL,
    montantEnchere DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (IdLot) REFERENCES LOT(IdLot),
    FOREIGN KEY (IdAcheteur) REFERENCES ACHETEUR(IdAcheteur)
);

-- Insertion dans la table BATEAU
INSERT INTO BATEAU (IdBateau, nomBateau, capaciteBateau) VALUES
(1, 'Le Neptune', 200.00),
(2, "L'Horizon", 150.00),
(3, "L'Aventurier", 180.00);

-- Insertion dans la table ESPECE
INSERT INTO ESPECE (IdEspece, nomScientifique, nomCommun) VALUES
(1, 'Gadus morhua', 'Morue'),
(2, 'Sardina pilchardus', 'Sardine'),
(3, 'Psetta maxima', 'Sole');

-- Insertion dans la table PRESENTATION
INSERT INTO PRESENTATION (IdPresentation, descriptionPresentation) VALUES
(1, 'Filets'),
(2, 'Poisson entier'),
(3, 'Découpé en morceaux');

-- Insertion dans la table TAILLE
INSERT INTO TAILLE (IdTaille, descriptionTaille) VALUES
(1, 'Petite taille'),
(2, 'Moyenne taille'),
(3, 'Grande taille');

-- Insertion dans la table QUALITE
INSERT INTO QUALITE (IdQualite, descriptionQualite) VALUES
(1, 'Excellente'),
(2, 'Bonne'),
(3, 'Moyenne');

-- Insertion dans la table BAC
INSERT INTO BAC (IdBac, tare) VALUES
(1, 50.00),
(2, 60.00);

-- Insertion dans la table ACHETEUR
INSERT INTO ACHETEUR (login, pwd, raisonSocialeEntreprise, adresse, ville, codePostal, numHabilitation) VALUES
('acheteur1', 'pass123', 'Société de Pêche SA', '1 rue des Pêcheurs', 'Villemarine', '75001', 'HAB1234567'),
('acheteur2', 'pass456', 'Pêche et Co', '2 quai du Port', 'Portville', '75002', 'HAB7654321'),
('test', 'test', 'test', 'test', 'test', 'test', 'test');

-- Insertion dans la table ADMINISTRATEUR (nouveau)
INSERT INTO ADMINISTRATEUR (loginAdmin, pwdAdmin, nom, prenom) VALUES
('admin1', 'test123', 'Bersuder', 'Baptiste'),
('admin2', 'test456', 'Pham', 'Billy'),
('admin3', 'test789', 'Laaraj', 'Mohamed');

-- Insertion dans la table FACTURE
INSERT INTO FACTURE (IdFacture, IdAcheteur, dateEmission, montantTotal) VALUES
(1, 1, '2024-12-03', 1500.00),
(2, 2, '2024-12-04', 1200.00);

-- Insertion dans la table IMAGE
INSERT INTO IMAGE (ImageLot) VALUES
('img/lot1.jpg'),
('img/lot2.jpg'),
('img/lot3.jpg'),
('img/lot4.jpg'),
('img/lot5.jpg'),
('img/lot6.jpg'),
('img/lot7.jpg'),
('img/lot8.jpg');

-- Insertion dans la table LOT
INSERT INTO LOT (IdLot, IdBateau, datePeche, IdEspece, IdTaille, IdPresentation, IdBac, IdAcheteur, IdQualite, IdImage , poidsBrutLot, prixDepart, prixEnchereActuelle, dateOuverture, dateFin, heureOuverture, heureFin, statut, IdFacture, IdAdmin) VALUES
(1, 1, '2024-12-12', 1, 2, 1, 1, null, 1, 1, 1000.00, 800.00, 800.00, '2025-01-01', '2025-01-06', '05:00:00','22:30:00', 'future', 1, 1),
(2, 2, '2024-12-18', 2, 1, 3, 2, null, 2, 2, 500.00, 400.00, 400.00, '2025-01-02', '2025-01-06', '05:00:00','23:59:59', 'future', 2, 2),
(3, 3, '2024-12-03', 3, 3, 2, 1, null, 3, 3, 1000.00, 800.00, 800.00, '2025-01-02', '2025-01-07', '05:00:00','23:59:59', 'future', 1, 3),
(4, 3, '2024-12-08', 2, 1, 3, 2, null, 2, 4, 500.00, 400.00, 400.00, '2025-01-02', '2025-01-07', '05:00:00','23:59:59', 'future', 2, 2),
(5, 1, '2024-12-22', 1, 2, 1, 1, null, 1, 5, 1000.00, 800.00, 800.00, '2025-03-01', '2025-03-04', '05:00:00','23:59:59', 'future', 1, 1),
(6, 2, '2024-12-30', 3, 3, 2, 1, null, 2, 6, 500.00, 400.00, 400.00, '2025-03-01', '2025-03-05', '05:00:00','23:59:59', 'future', 2, 3),
(7, 3, '2024-12-31', 2, 2, 3, 2, null, 3, 7, 500.00, 400.00, 400.00, '2025-03-01', '2025-03-05', '05:00:00','23:59:59', 'future', 2, 1),
(8, 1, '2024-12-04', 2, 1, 2, 2, null, 2, 8, 500.00, 400.00, 400.00, '2025-03-01', '2025-03-05', '05:00:00','23:59:59', 'future', 2, 2);

DELIMITER //
CREATE TRIGGER after_lot_closed
AFTER UPDATE ON lot
FOR EACH ROW
BEGIN
    -- Déclarer les variables nécessaires
    DECLARE winning_bidder INT;
    DECLARE winning_bid DECIMAL(10, 2);

    -- Vérifier si le statut du lot a changé en "fermee"
    IF NEW.statut = 'fermee' AND OLD.statut = 'ouverte' THEN
        -- Trouver l'acheteur ayant la plus grande enchère pour ce lot
        SELECT IdAcheteur, MAX(montantEnchere) INTO winning_bidder, winning_bid
        FROM historique_encheres
        WHERE IdLot = NEW.IdLot
        GROUP BY IdLot
        ORDER BY winning_bid DESC
        LIMIT 1;

        -- Si un gagnant est trouvé
        IF winning_bidder IS NOT NULL THEN
            -- Insérer l'acheteur dans la table panier
            INSERT INTO panier (IdLot, IdAcheteur, montantEnchere)
            VALUES (NEW.IdLot, winning_bidder, winning_bid);
        END IF;
    END IF;
END; //
DELIMITER ;

DELIMITER //

CREATE FUNCTION calculer_total_panier(idAcheteur INT) 
RETURNS DECIMAL(10, 2)
DETERMINISTIC
BEGIN
    DECLARE total DECIMAL(10, 2) DEFAULT 0;

    -- Sélectionner le total des enchères gagnées pour cet acheteur
    SELECT SUM(p.montantEnchere) 
    INTO total
    FROM panier p
    JOIN lot l ON p.IdLot = l.IdLot
    WHERE p.IdAcheteur = idAcheteur;

    -- Retourner le total calculé
    RETURN total;
END //

DELIMITER ;

