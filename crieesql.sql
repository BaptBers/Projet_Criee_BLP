DROP DATABASE IF EXISTS PROJET_CRIEE;
CREATE DATABASE PROJET_CRIEE;
USE PROJET_CRIEE;

-- Table BATEAU
CREATE TABLE BATEAU (
    IdBateau INT PRIMARY KEY,
    immatBateau VARCHAR(255) NOT NULL,
    nomBateau VARCHAR(255) NOT NULL
);

-- Table PECHE
CREATE TABLE PECHE (
    IdBateau INT,
    datePeche DATE NOT NULL,
    PRIMARY KEY(IdBateau, datePeche),
    FOREIGN KEY (IdBateau) REFERENCES BATEAU(IdBateau)
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
    IdTaille INT PRIMARY KEY
);

-- Table QUALITE
CREATE TABLE QUALITE (
    IdQualite INT PRIMARY KEY,
    descriptionQualite VARCHAR(255) NOT NULL
);

-- Table BAC
CREATE TABLE BAC (
    IdBac INT PRIMARY KEY,
    designationTaille VARCHAR(255) NOT NULL,
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
    IdFacture INT AUTO_INCREMENT PRIMARY KEY,
    dateCommande DATE NOT NULL,
    heureCommande DATETIME NOT NULL,
    montantTotal DECIMAL(10, 2) NOT NULL,
    IdAcheteur INT NOT NULL,
    FOREIGN KEY (IdAcheteur) REFERENCES ACHETEUR(IdAcheteur)
);

CREATE TABLE facture_details (
    idDetail INT AUTO_INCREMENT PRIMARY KEY,
    IdFacture INT NOT NULL,
    IdLot INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (IdFacture) REFERENCES facture(IdFacture),
    FOREIGN KEY (IdLot) REFERENCES lot(IdLot)
);
-- Table LOT
CREATE TABLE LOT (
    IdLot INT AUTO_INCREMENT,
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
    prixFinale DECIMAL(10, 2),
    dateOuverture DATE,
    dateFin DATE,
    heureOuverture TIME,
    heureFin TIME,
    statut VARCHAR(50),
    IdFacture INT,
    IdAdmin INT NOT NULL, 
    PRIMARY KEY (IdLot,IdBateau,datePeche),
    FOREIGN KEY (IdBateau, datePeche) REFERENCES PECHE(IdBateau, datePeche),
    FOREIGN KEY (IdAdmin) REFERENCES ADMINISTRATEUR(IdAdmin),
    FOREIGN KEY (idImage) REFERENCES IMAGE(IdImage),
    FOREIGN KEY (IdEspece) REFERENCES ESPECE(IdEspece),
    FOREIGN KEY (IdTaille) REFERENCES TAILLE(IdTaille),
    FOREIGN KEY (IdPresentation) REFERENCES PRESENTATION(IdPresentation),
    FOREIGN KEY (IdBac) REFERENCES BAC(IdBac),
    FOREIGN KEY (IdAcheteur) REFERENCES HISTORIQUE_ENCHERES(IdAcheteur),
    FOREIGN KEY (IdQualite) REFERENCES QUALITE(IdQualite),
    FOREIGN KEY (IdFacture) REFERENCES FACTURE(IdFacture)

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
INSERT INTO BATEAU (IdBateau, immatBateau, nomBateau) VALUES
(1, "KJ-567-PH", "Le Neptune"),
(2, "ML-231-HA", "L'Horizon"),
(3, "HA-903-BZ", "L'Aventurier");

-- Insertion dans la table PECHE
INSERT INTO PECHE (IdBateau, datePeche) VALUES
(1, '2024-12-07'),
(2, '2024-12-10'),
(2, '2024-12-08'),
(1, '2024-12-12'),
(3, '2024-12-17'),
(3, '2024-12-22');

-- Insertion dans la table ESPECE
INSERT INTO ESPECE ( IdEspece, nomScientifique, nomCommun) VALUES
(1, 'Gadus morhua', 'Morue'),
(2, 'Sardina pilchardus', 'Sardine'),
(3, 'Psetta maxima', 'Sole'),
(4, 'Merluccius merluccius', 'Merlu'),
(5, 'Pollachius pollachius', 'Lieu jaune'),
(6, 'Micromesistius poutassou', 'Merlan bleu'),
(7, 'Scomber scombrus', 'Maquereau'),
(8, 'Melanogrammus aeglefinus', 'Églefin');

-- Insertion dans la table PRESENTATION
INSERT INTO PRESENTATION (IdPresentation, descriptionPresentation) VALUES
(1, 'Filets'),
(2, 'Entier'),
(3, 'Vidé'),
(4, 'Morceaux');

-- Insertion dans la table TAILLE
INSERT INTO TAILLE (IdTaille) VALUES
(10),
(20),
(30),
(40),
(50),
(60),
(70),
(80),
(90);

-- Insertion dans la table QUALITE
INSERT INTO QUALITE (IdQualite, descriptionQualite) VALUES
(1, 'E Extra'),
(2, 'A Glacé'),
(3, 'B Déclassé');

-- Insertion dans la table BAC
INSERT INTO BAC (IdBac, designationTaille, tare) VALUES
(1, 'B Petite taille', 2.5),
(2, 'F Grande taille', 4.0);

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

-- -- Insertion dans la table FACTURE
-- INSERT INTO FACTURE (IdAcheteur, dateEmission, montantTotal) VALUES
-- (1, 3,  '2024-12-03', 1500.00),
-- (2, 2,'2024-12-04', 1200.00);

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
INSERT INTO LOT (IdBateau, datePeche, IdEspece, IdTaille, IdPresentation, IdBac, IdAcheteur, IdQualite, IdImage , poidsBrutLot, prixDepart, prixEnchereActuelle, dateOuverture, dateFin, heureOuverture, heureFin, statut, IdFacture, IdAdmin) VALUES
(1, '2025-04-07', 1, 10, 1, 1, null, 1, 1, 7.50, 800.00, 800.00, '2025-04-10', '2025-04-15', '05:00:00','11:08:00', 'future' , 1, 1),
(1, '2025-04-07', 2, 20, 3, 2, null, 2, 2, 10.00, 400.00, 400.00, '2025-04-10', '2025-04-15', '11:09:00','16:59:59', 'future' , 1, 2),
(1, '2025-04-07', 3, 30, 2, 1, null, 3, 3, 5.00, 800.00, 800.00, '2025-04-10', '2025-04-15', '05:00:00','11:59:59', 'future', 1, 3),
(1, '2025-04-07', 2, 40, 4, 1, null, 2, 4, 6.50, 400.00, 400.00, '2025-03-10', '2025-03-15', '05:00:00','13:59:59', 'future', 2, 2),
(1, '2025-04-07', 1, 50, 1, 2, null, 3, 5, 9.50, 800.00, 800.00, '2025-04-25', '2025-04-30', '05:00:00','23:59:59', 'future', 1, 1),
(1, '2025-04-07', 3, 60, 2, 1, null, 2, 6, 13.00, 400.00, 400.00, '2025-04-25', '2025-04-30', '05:00:00','23:59:59', 'future', 2, 3),
(1, '2025-04-07', 2, 70, 3, 1, null, 1, 7, 4.50, 400.00, 400.00, '2025-04-25', '2025-04-30', '05:00:00','23:59:59', 'future', 2, 1),
(1, '2025-04-07', 2, 80, 4, 2, null, 2, 8, 8.00, 400.00, 400.00, '2025-03-25', '2025-03-30', '05:00:00','23:59:59', 'future', 2, 2);

DELIMITER //
CREATE TRIGGER after_lot_closed
AFTER UPDATE ON lot
FOR EACH ROW
BEGIN
    DECLARE winning_bidder INT;
    DECLARE winning_bid DECIMAL(10, 2);

    IF NEW.statut = 'fermee' AND OLD.statut = 'ouverte' THEN
        -- Récupérer l'acheteur ayant placé la plus grosse enchère
        SELECT he.IdAcheteur, he.montantEnchere
        INTO winning_bidder, winning_bid
        FROM historique_encheres he
        WHERE he.IdLot = NEW.IdLot
        ORDER BY he.montantEnchere DESC, he.dateEnchere DESC
        LIMIT 1;

        -- Si on a trouvé un gagnant, on l'ajoute au panier
        IF winning_bidder IS NOT NULL THEN
            INSERT INTO panier (IdLot, IdAcheteur, montantEnchere)
            VALUES (NEW.IdLot, winning_bidder, winning_bid);
        END IF;
    END IF;
END;
//
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

DELIMITER //

CREATE FUNCTION calcul_poids_net(idLot INT) 
RETURNS DECIMAL(10, 2)
DETERMINISTIC
BEGIN
    DECLARE total DECIMAL(10, 2) DEFAULT 0;

    SELECT poidsBrutLot - tare
    INTO total
    FROM lot, bac
    WHERE lot.IdBac = bac.IdBac AND lot.IdLot = idLot;

    RETURN total;
END //

DELIMITER ;

DELIMITER //
CREATE TRIGGER before_lot_insert
BEFORE INSERT ON lot
FOR EACH ROW
BEGIN
    -- Déclarer les variables nécessaires
    SET NEW.statut = 'future';
END; //
DELIMITER ;

