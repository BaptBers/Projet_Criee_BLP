DROP DATABASE IF EXISTS FOURNIL ;
CREATE DATABASE IF NOT EXISTS FOURNIL ;
USE FOURNIL ;

CREATE TABLE CATEGORIE(
    codeCategorie VARCHAR(50) PRIMARY KEY,
    denominationCategorie VARCHAR(50),
    nomEmploye VARCHAR(50)
);

CREATE TABLE ALLERGENE(
    numAllergene INT PRIMARY KEY AUTO_INCREMENT,
    denominationAllergene VARCHAR(50)
);

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL
);

CREATE TABLE PRODUIT(
    refProduit VARCHAR(4) PRIMARY KEY,
    photoProduit VARCHAR(50),
    prixProduit VARCHAR(8),
    poidsProduit INT,
    descriptionProduit VARCHAR(200),
    designationProduit VARCHAR(200),
    codeCategorie VARCHAR(50),
    FOREIGN KEY (codeCategorie) REFERENCES CATEGORIE(codeCategorie)
);

CREATE TABLE CONTIENT(
    refProduit VARCHAR(4), 
    numAllergene INT,
    presence BOOLEAN,
    trace BOOLEAN,
    PRIMARY KEY(refProduit, numAllergene),
    FOREIGN KEY (refProduit) REFERENCES PRODUIT(refProduit),
    FOREIGN KEY (numAllergene) REFERENCES ALLERGENE(numAllergene)
);

CREATE TABLE COMMANDE (
    idCommande INT AUTO_INCREMENT PRIMARY KEY,
    idUtilisateur INT,
    dateCommande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(id)
);

CREATE TABLE SOUS_COMMANDE (
    idSousCommande INT AUTO_INCREMENT PRIMARY KEY,
    idCommande INT,
    refProduit VARCHAR(4),
    quantite INT NOT NULL,
    FOREIGN KEY (idCommande) REFERENCES COMMANDE(idCommande),
    FOREIGN KEY (refProduit) REFERENCES PRODUIT(refProduit)
);

INSERT INTO CATEGORIE(codeCategorie, denominationCategorie, nomEmploye) VALUES 
    ('catPain', 'Liste de pains', 'Billy'),
    ('catVien', 'Liste de viennoiseries', 'Baptiste'),
    ('catSpe', 'Liste de spécialités', 'Mohamed');

INSERT INTO ALLERGENE(denominationAllergene) VALUES 
    ('gluten'),
    ('levain'),
    ('lin'),
    ('tournesol'),
    ('sésame'),
    ('chocolat'),
    ('pommes'),
    ('olives'),
    ('miel'),
    ('cannelle'),
    ('épices'),
    ('amandes'),
    ('fruits à coques');

INSERT INTO PRODUIT(refProduit, photoProduit, prixProduit, poidsProduit, descriptionProduit, designationProduit, codeCategorie) VALUES
    ('P001', 'img/pains/baguette250gr.png','1.30', '250', 'Une baguette croustillante à la croûte dorée pour accompagner vos repas ou pour réaliser des sandwichs.', 'Baguette traditionnelle','catPain'),
    ('P002', 'img/pains/painCampagne400gr.png','3.80', '400', 'Un pain rustique au levain, avec une mie généreuse et un goût légèrement acidulé.', 'Pain de campagne','catPain'),
    ('P003', 'img/pains/painCereales350gr.png','4', '350', 'Pain moelleux aux graines de lin, tournesol et sésame, pour une texture légèrement croquante.', 'Pain aux céréales','catPain'),
    ('V001', 'img/viennoiseries/croissantBeurre50gr.png','1.30', '50', "Un classique de la boulangerie, un croissant feuilleté, croustillant à l'extérieur, tendre et fondant àl'intérieur.", 'Croissant pur beurre','catVien'),
    ('V002', 'img/viennoiseries/painChocolat50gr.png','2.60', '50', "Une viennoiserie gourmande, avec une généreuse barre chocolatée enveloppée dans une pâte feuilletée. croustillante", 'Pain au chocolat','catVien'),
    ('V003', 'img/viennoiseries/chaussonPommes90gr.png','2.90', '90', 'Un chausson croustillant garni de compote de pommes maison, saupoudré de sucre et de cannelle.', 'Chausson aux pommes','catVien'),
    ('S001','img/specialites/fougasseOlives400gr.jpg','2', '400', 'Une spécialité provençale, une focaccia moelleuse aux olives noires. Une portion.', 'Fougasse aux olives','catSpe'),
    ('S002', 'img/specialites/painEpicesMaison500gr.jpg','5.50', '500', "Un pain d'épices traditionnel, moelleux et parfumé, aux arômes de miel, de cannelle.", "Pain d'épices",'catSpe'),
    ('S003', 'img/specialites/galetteFrangipane660gr.png','18', '660', "Une galette pour 4 personnes à base de pâte d’amandes. Prix au kg.", 'Galette frangipane','catSpe');

INSERT INTO CONTIENT(refProduit, numAllergene, presence, trace) VALUES
    ('P001','1','1','0'),
    ('P002','1','1','0'),
    ('P002','2','1','0'),
    ('P003','1','1','0'),
    ('P003','3','1','0'),
    ('P003','4','1','0'),
    ('P003','5','1','0'),
    ('V001','1','1','0'),
    ('V002','1','1','0'),
    ('V002','6','1','0'),
    ('V003','1','1','0'),
    ('V003','7','1','0'),
    ('S001','1','1','0'),
    ('S001','8','1','0'),
    ('S002','1','1','0'),
    ('S002','9','1','0'),
    ('S002','10','1','0'),
    ('S002','11','1','0'),
    ('S003','1','1','0'),
    ('S003','12','1','0'),
    ('S003','13','0','1');

CREATE VIEW VueFournil AS
SELECT 
    PRODUIT.refProduit,
    PRODUIT.photoProduit,
    PRODUIT.prixProduit,
    PRODUIT.poidsProduit,
    PRODUIT.descriptionProduit,
    PRODUIT.designationProduit,
    CATEGORIE.codeCategorie,
    CATEGORIE.denominationCategorie,
    CATEGORIE.nomEmploye,
    GROUP_CONCAT(ALLERGENE.denominationAllergene) AS Allergenes,
    GROUP_CONCAT(CONCAT('Présence de ', ALLERGENE.denominationAllergene, ': ', CONTIENT.presence) SEPARATOR ', ') AS Presence_Allergenes,
    GROUP_CONCAT(CONCAT('Trace de ', ALLERGENE.denominationAllergene, ': ', CONTIENT.trace) SEPARATOR ', ') AS Trace_Allergenes
FROM 
    PRODUIT, CATEGORIE, ALLERGENE, CONTIENT
WHERE 
    PRODUIT.codeCategorie = CATEGORIE.codeCategorie
    AND CONTIENT.refProduit = PRODUIT.refProduit
    AND CONTIENT.numAllergene = ALLERGENE.numAllergene
GROUP BY 
    PRODUIT.refProduit;


DROP USER IF EXISTS 'Visiteur'@'%', 'MmeKeller'@'%';

CREATE USER 'Visiteur'@'%' IDENTIFIED BY 'azerty67000$';

GRANT SELECT ON FOURNIL.VueFournil TO 'Visiteur'@'%';

CREATE USER 'MmeKeller'@'%' IDENTIFIED BY 'querty67000$';

GRANT SELECT, INSERT, UPDATE, DELETE ON FOURNIL.* TO 'MmeKeller'@'%';

FLUSH PRIVILEGES;