DROP DATABASE IF EXISTS PROJET_CRIEE;
CREATE DATABASE PROJET_CRIEE;
USE PROJET_CRIEE;


-- Table BATEAU
CREATE TABLE BATEAU (
    IdBateau INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    capacite DECIMAL(10, 2) NOT NULL
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
    description VARCHAR(255) NOT NULL
);

-- Table TAILLE
CREATE TABLE TAILLE (
    IdTaille INT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
);

-- Table QUALITE
CREATE TABLE QUALITE (
    IdQualite INT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
);


-- Table PECHE
CREATE TABLE PECHE (
    IdBateau INT NOT NULL,
    datePeche DATE NOT NULL,
    PRIMARY KEY (IdBateau, datePeche),
    FOREIGN KEY (IdBateau) REFERENCES BATEAU(IdBateau)
);




-- Table BAC
CREATE TABLE BAC (
    IdBac INT PRIMARY KEY,
    tare DECIMAL(10, 2) NOT NULL
);

-- Table ACHETEUR
CREATE TABLE ACHETEUR (
    IdAcheteur INT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    pwd VARCHAR(50) NOT NULL,
    raisonSocialeEntreprise VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    codePostal VARCHAR(5) NOT NULL,
    numHabilitation VARCHAR(50) 
);

-- Table IMAGE
CREATE TABLE IMAGE (
    IdImage INT PRIMARY KEY,
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
    IdAcheteur INT NOT NULL,
    IdQualite INT NOT NULL,
    idImage INT NOT NULL,
    poidsBrutLot DECIMAL(10, 2) NOT NULL,
    prixPlancher DECIMAL(10, 2) NOT NULL,
    prixDepart DECIMAL(10, 2) NOT NULL,
    prixEncheresMax DECIMAL(10, 2),
    dateEnchere DATE,
    heureDebutEnchere TIME,
    codeEtat VARCHAR(50),
    IdFacture INT,
    FOREIGN KEY (idImage) REFERENCES IMAGE(IdImage),
    PRIMARY KEY (IdLot, IdBateau, datePeche),
    FOREIGN KEY (IdEspece) REFERENCES ESPECE(IdEspece),
    FOREIGN KEY (IdBateau, datePeche) REFERENCES PECHE(IdBateau, datePeche),
    FOREIGN KEY (IdTaille) REFERENCES TAILLE(IdTaille),
    FOREIGN KEY (IdPresentation) REFERENCES PRESENTATION(IdPresentation),
    FOREIGN KEY (IdBac) REFERENCES BAC(IdBac),
    FOREIGN KEY (IdAcheteur) REFERENCES ACHETEUR(IdAcheteur),
    FOREIGN KEY (IdQualite) REFERENCES QUALITE(IdQualite)
);

-- Table POSTER
CREATE TABLE POSTER (
    IdLot INT NOT NULL,
    datePeche DATE NOT NULL,
    IdBateau INT NOT NULL,
    IdAcheteur INT NOT NULL,
    prixEnchere DECIMAL(10, 2),
    heureEnchere TIME,
    PRIMARY KEY (IdLot, IdAcheteur, datePeche, IdBateau),
    FOREIGN KEY (IdAcheteur) REFERENCES ACHETEUR(IdAcheteur),
    FOREIGN KEY (IdLot, IdBateau, datePeche) REFERENCES LOT(IdLot, IdBateau, datePeche)
);

-- Insertion dans la table BATEAU
INSERT INTO BATEAU (IdBateau, nom, capacite) VALUES
(1, 'Le Neptune', 200.00),
(2, "L'Horizon", 150.00),
(3, "L'Aventurier", 180.00);

-- Insertion dans la table ESPECE
INSERT INTO ESPECE (IdEspece, nomScientifique, nomCommun) VALUES
(1, 'Gadus morhua', 'Morue'),
(2, 'Sardina pilchardus', 'Sardine'),
(3, 'Psetta maxima', 'Sole');

-- Insertion dans la table PRESENTATION
INSERT INTO PRESENTATION (IdPresentation, description) VALUES
(1, 'Filets'),
(2, 'Poisson entier'),
(3, 'Découpé en morceaux');

-- Insertion dans la table TAILLE
INSERT INTO TAILLE (IdTaille, description) VALUES
(1, 'Petite taille'),
(2, 'Moyenne taille'),
(3, 'Grande taille');

-- Insertion dans la table QUALITE
INSERT INTO QUALITE (IdQualite, description) VALUES
(1, 'Excellente'),
(2, 'Bonne'),
(3, 'Moyenne');

-- Insertion dans la table PECHE
INSERT INTO PECHE (IdBateau, datePeche) VALUES
(1, '2024-12-01'),
(2, '2024-12-02'),
(3, '2024-12-03');

-- Insertion dans la table BAC
INSERT INTO BAC (IdBac, tare) VALUES
(1, 50.00),
(2, 60.00);

-- Insertion dans la table ACHETEUR
INSERT INTO ACHETEUR (IdAcheteur, login, pwd, raisonSocialeEntreprise, adresse, ville, codePostal, numHabilitation) VALUES
(1, 'acheteur1', 'pass123', 'Société de Pêche SA', '1 rue des Pêcheurs', 'Villemarine', '75001', 'HAB1234567'),
(2, 'acheteur2', 'pass456', 'Pêche et Co', '2 quai du Port', 'Portville', '75002', 'HAB7654321');

-- Insertion dans la table FACTURE
INSERT INTO FACTURE (IdFacture, IdAcheteur, dateEmission, montantTotal) VALUES
(1, 1, '2024-12-03', 1500.00),
(2, 2, '2024-12-04', 1200.00);

-- Insertion dans la table IMAGE
INSERT INTO FACTURE (IdFacture, IdAcheteur, dateEmission, montantTotal) VALUES
(1, 'siteCriee/img/lot1.jpeg'),
(2, 'siteCriee/img/lot2.jpeg'),
(3, 'siteCriee/img/lot3.jpg'),
(4, 'siteCriee/img/lot4.jpg'),
(5, 'siteCriee/img/lot5.jpg'),
(6, 'siteCriee/img/lot6.jpg');

-- Insertion dans la table LOT
INSERT INTO LOT (IdLot, IdBateau, datePeche, IdEspece, IdTaille, IdPresentation, IdBac, IdAcheteur, IdQualite, IdImage , poidsBrutLot, prixPlancher, prixDepart, prixEncheresMax, dateEnchere, heureDebutEnchere, codeEtat, IdFacture) VALUES
(1, 1, '2024-12-01', 1, 2, 1, 1, 1, 1, 1, 1000.00, 800.00, 850.00, 1000.00, '2024-12-05', '10:00:00', 'Enchère ouverte', 1),
(2, 2, '2024-12-02', 2, 1, 2, 2, 2, 2, 2, 500.00, 400.00, 450.00, 500.00, '2024-12-06', '11:00:00', 'Enchère fermée', 2);
(3, 3, '2024-12-06', 1, 2, 1, 1, 1, 1, 3, 1000.00, 800.00, 850.00, 1000.00, '2024-12-05', '10:00:00', 'Enchère ouverte', 1),
(4, 3, '2024-12-07', 2, 1, 2, 2, 2, 2, 4, 500.00, 400.00, 450.00, 500.00, '2024-12-06', '11:00:00', 'Enchère fermée', 2);
(5, 1, '2024-12-09', 1, 2, 1, 1, 1, 1, 5, 1000.00, 800.00, 850.00, 1000.00, '2024-12-05', '10:00:00', 'Enchère ouverte', 1),
(6, 2, '2024-12-11', 2, 1, 2, 2, 2, 2, 6, 500.00, 400.00, 450.00, 500.00, '2024-12-06', '11:00:00', 'Enchère fermée', 2);


-- Insertion dans la table POSTER
INSERT INTO POSTER (IdLot, datePeche, IdBateau, IdAcheteur, prixEnchere, heureEnchere) VALUES
(1, '2024-12-01', 1, 1, 900.00, '10:15:00'),
(2, '2024-12-02', 2, 2, 450.00, '11:30:00');
