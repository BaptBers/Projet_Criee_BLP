DROP DATABASE IF EXISTS PROJET_CRIEE;
CREATE DATABASE PROJET_CRIEE;
USE PROJET_CRIEE;

-- Table BATEAU
CREATE TABLE bateau (
    IdBateau INT PRIMARY KEY,
    immatBateau VARCHAR(255) NOT NULL,
    nomBateau VARCHAR(255) NOT NULL
);

-- Table PECHE
CREATE TABLE peche (
    IdBateau INT,
    datePeche DATE NOT NULL,
    PRIMARY KEY(IdBateau, datePeche),
    FOREIGN KEY (IdBateau) REFERENCES bateau(IdBateau)
);

-- Table ESPECE
CREATE TABLE espece (
    IdEspece INT PRIMARY KEY,
    nomScientifique VARCHAR(255) NOT NULL,
    nomCommun VARCHAR(255) NOT NULL
);

-- Table PRESENTATION
CREATE TABLE presentation (
    IdPresentation INT PRIMARY KEY,
    descriptionPresentation VARCHAR(255) NOT NULL
);

-- Table TAILLE
CREATE TABLE taille (
    IdTaille INT PRIMARY KEY
);

-- Table QUALITE
CREATE TABLE qualite (
    IdQualite INT PRIMARY KEY,
    descriptionQualite VARCHAR(255) NOT NULL
);

-- Table BAC
CREATE TABLE bac (
    IdBac INT PRIMARY KEY,
    designationTaille VARCHAR(255) NOT NULL,
    tare DECIMAL(10, 2) NOT NULL
);

-- Table ACHETEUR
CREATE TABLE acheteur (
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
CREATE TABLE administrateur (
    IdAdmin INT AUTO_INCREMENT PRIMARY KEY,
    loginAdmin VARCHAR(50) NOT NULL UNIQUE,
    pwdAdmin VARCHAR(50) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL
);

-- Table IMAGE
CREATE TABLE image (
    IdImage INT AUTO_INCREMENT PRIMARY KEY,
    ImageLot VARCHAR(255) NOT NULL
    
);

-- Table FACTURE
CREATE TABLE facture (
    IdFacture INT AUTO_INCREMENT PRIMARY KEY,
    dateCommande DATE NOT NULL,
    heureCommande DATETIME NOT NULL,
    montantTotal DECIMAL(10, 2) NOT NULL,
    IdAcheteur INT NOT NULL,
    FOREIGN KEY (IdAcheteur) REFERENCES acheteur(IdAcheteur)
);

-- Table LOT
CREATE TABLE lot (
    IdLot INT AUTO_INCREMENT,
    IdBateau INT NOT NULL,
    datePeche DATE NOT NULL,
    IdEspece INT NOT NULL,
    IdTaille INT NOT NULL,
    IdPresentation INT NOT NULL,
    IdBac INT NOT NULL,
    IdQualite INT NOT NULL,
    idImage INT NOT NULL,
    poidsBrutLot DECIMAL(10, 2) NOT NULL,
    prixDepart DECIMAL(10, 2) NOT NULL,
    prixEnchereActuelle DECIMAL(10, 2) NOT NULL,
    prixFinal DECIMAL(10, 2),
    dateOuverture DATE,
    dateFin DATE,
    heureOuverture TIME,
    heureFin TIME,
    statut VARCHAR(50),
    IdFacture INT,
    IdAdmin INT NOT NULL, 
    PRIMARY KEY (IdLot,IdBateau,datePeche),
    FOREIGN KEY (IdBateau, datePeche) REFERENCES peche(IdBateau, datePeche),
    FOREIGN KEY (IdAdmin) REFERENCES administrateur(IdAdmin),
    FOREIGN KEY (idImage) REFERENCES image(IdImage),
    FOREIGN KEY (IdEspece) REFERENCES espece(IdEspece),
    FOREIGN KEY (IdTaille) REFERENCES taille(IdTaille),
    FOREIGN KEY (IdPresentation) REFERENCES presentation(IdPresentation),
    FOREIGN KEY (IdBac) REFERENCES bac(IdBac),
    FOREIGN KEY (IdQualite) REFERENCES qualite(IdQualite),
    FOREIGN KEY (IdFacture) REFERENCES facture(IdFacture)
);

-- Table HISTORIQUE_ENCHERES
CREATE TABLE historique_encheres(
    IdLot INT NOT NULL,
    IdAcheteur INT NOT NULL,
    montantEnchere DECIMAL(10, 2) NOT NULL,
    dateEnchere DATETIME,
    PRIMARY KEY (IdLot, IdAcheteur, dateEnchere),
    FOREIGN KEY (IdAcheteur) REFERENCES acheteur(IdAcheteur),
    FOREIGN KEY (IdLot) REFERENCES lot(IdLot)
);

-- Table FACTURE_DETAILS
CREATE TABLE facture_details (
    idDetail INT AUTO_INCREMENT PRIMARY KEY,
    IdFacture INT NOT NULL,
    IdLot INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (IdFacture) REFERENCES facture(IdFacture),
    FOREIGN KEY (IdLot) REFERENCES lot(IdLot)
);

-- Table PANIER
CREATE TABLE panier (
    IdPanier INT AUTO_INCREMENT PRIMARY KEY,
    IdLot INT NOT NULL,
    IdAcheteur INT NOT NULL,
    montantEnchere DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (IdLot) REFERENCES lot(IdLot),
    FOREIGN KEY (IdAcheteur) REFERENCES acheteur(IdAcheteur)
);

-- Insertion dans la table BATEAU
INSERT INTO bateau (IdBateau, immatBateau, nomBateau) VALUES
(1, "KJ-567-PH", "Le Neptune"),
(2, "ML-231-HA", "L'Horizon"),
(3, "HA-903-BZ", "L'Aventurier"),
(4, "TR-812-MN", "L'Étoile du Nord"),
(5, "XZ-445-KL", "Le Vent du Large"),
(6, "BN-098-ZT", "La Sirène des Mers"),
(7, "QP-672-WX", "L’Odyssée");

-- Insertion dans la table PECHE
INSERT INTO peche (IdBateau, datePeche) VALUES
(1, '2025-04-07'),
(2, '2025-04-10'),
(3, '2025-04-08'),
(4, '2025-04-12'),
(6, '2025-04-13'),
(7, '2025-04-01');

-- Insertion dans la table ESPECE
INSERT INTO espece ( IdEspece, nomScientifique, nomCommun) VALUES
(1, 'Mullus surmuletus', 'Rouget barbet'),
(2, 'Pollachius pollachius', 'Lieu jaune'),
(3, 'Homarus gammarus', 'Homard'),
(4, 'Merluccius merluccius', 'Merlu'),
(5, 'Heterocarpus affinis', 'Crevettes'),
(6, 'Sardina pilchardus ', 'Sardine'),
(7, 'Psetta maxima', 'Sole'),
(8, 'Scorpaena scrofa', 'Rascasse Rouge');

-- Insertion dans la table PRESENTATION
INSERT INTO presentation (IdPresentation, descriptionPresentation) VALUES
(1, 'Filets'),
(2, 'Entier'),
(3, 'Vidé'),
(4, 'Morceaux');

-- Insertion dans la table TAILLE
INSERT INTO taille (IdTaille) VALUES
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
INSERT INTO qualite (IdQualite, descriptionQualite) VALUES
(1, 'E Extra'),
(2, 'A Glacé'),
(3, 'B Déclassé');

-- Insertion dans la table BAC
INSERT INTO bac (IdBac, designationTaille, tare) VALUES
(1, 'B Petite taille', 2.5),
(2, 'F Grande taille', 4.0);

-- Insertion dans la table ACHETEUR
INSERT INTO acheteur (login, pwd, raisonSocialeEntreprise, adresse, ville, codePostal, numHabilitation) VALUES
('bersuder', 'baptiste', 'Société de Pêche SA', '1 rue des Pêcheurs', 'Villemarine', '56680', 'CP12345678'),
('laaraj', 'mohamed', 'Pêche et Co', '2 quai du Port', 'Portville', '56710', 'CP98715367'),
('pham', 'billy', 'Océan Prime SARL', '3 avenue de la Mer', 'Nautilia', '56420', 'CP72360915');

-- Insertion dans la table ADMINISTRATEUR (nouveau)
INSERT INTO administrateur (loginAdmin, pwdAdmin, nom, prenom) VALUES
('adminB', 'baptiste', 'Bersuder', 'Baptiste'),
('adminL', 'mohamed', 'Laaraj', 'Mohamed'),
('adminP', 'billy', 'Pham', 'Billy');

-- Insertion dans la table IMAGE
INSERT INTO image (ImageLot) VALUES
('img/lot1.jpg'),
('img/lot2.jpg'),
('img/lot3.jpg'),
('img/lot4.jpg'),
('img/lot5.jpg'),
('img/lot6.jpg'),
('img/lot7.jpg'),
('img/lot8.jpg');

-- Insertion dans la table LOT
INSERT INTO lot (IdBateau, datePeche, IdEspece, IdTaille, IdPresentation, IdBac, IdQualite, IdImage, poidsBrutLot, prixDepart, prixEnchereActuelle, dateOuverture, dateFin, heureOuverture, heureFin, statut, IdFacture, IdAdmin) VALUES
(1, '2025-04-07', 1, 10, 3, 1, 1, 1, 7.50, 8.00, 8.00, '2025-04-26', '2025-04-26', '07:00:00','23:00:00', 'future' , null, 1),
(2, '2025-04-10', 2, 20, 1, 2, 2, 2, 10.00, 10.00, 10.00, '2025-04-26', '2025-04-26', '07:00:00','23:00:00', 'future' , null, 2),
(4, '2025-04-12', 3, 30, 2, 1, 3, 3, 5.00, 5.00, 5.00, '2025-04-26', '2025-04-26', '07:00:00','23:00:00', 'future', null, 3),
(6, '2025-04-13', 4, 50, 4, 2, 3, 4, 9.50, 7.00, 7.00, '2025-04-30', '2025-05-02', '07:00:00','08:00:00', 'future', null, 1),
(7, '2025-04-01', 5, 60, 2, 1, 2, 5, 13.00, 13.00, 13.00, '2025-04-30', '2025-05-02', '07:00:00','08:00:00', 'future', null, 3),
(3, '2025-04-08', 6, 80, 2, 2, 2, 6, 8.00, 6.00, 6.00, '2025-04-30', '2025-05-02', '07:00:00','08:00:00', 'future', null, 2);

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

        -- Si on a trouvé un gagnant
        IF winning_bidder IS NOT NULL THEN
            -- Insérer dans le panier
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
    SET NEW.statut = 'future';
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER update_lot_idfacture_prixFinal
AFTER INSERT ON facture_details
FOR EACH ROW
BEGIN
    UPDATE lot
    SET 
        IdFacture = NEW.IdFacture,
        prixFinal = NEW.montant
    WHERE IdLot = NEW.IdLot;
END;
//
DELIMITER ;

