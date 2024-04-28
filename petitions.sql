

CREATE DATABASE Petitions_DB;
USE Petitions_DB;


CREATE TABLE Petition (
                          IDP INT AUTO_INCREMENT PRIMARY KEY,
                          Titre VARCHAR(255) NOT NULL,
                          Theme VARCHAR(100) NOT NULL,
                          Description TEXT,
                          DatePublic DATE,
                          DateFin DATE
);


CREATE TABLE Signature (
                           IDP INT,
                           IDS INT AUTO_INCREMENT PRIMARY KEY,
                           Nom VARCHAR(50) NOT NULL,
                           Prenom VARCHAR(50) NOT NULL,
                           Pays VARCHAR(50) NOT NULL,
                           Date DATE,
                           Heure TIME,
                           FOREIGN KEY (IDP) REFERENCES Petition(IDP)
);


INSERT INTO Petition (Titre, Theme, Description, DatePublic, DateFin) VALUES ('Test1', 'Test1', 'Test1', '2020-01-01', '2020-01-02');
INSERT INTO Petition (Titre, Theme, Description, DatePublic, DateFin) VALUES ('Test2', 'Test2', 'Test2', '2020-01-01', '2020-01-02');
INSERT INTO Petition (Titre, Theme, Description, DatePublic, DateFin) VALUES ('Test3', 'Test3', 'Test3', '2020-01-01', '2020-01-02');

INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (1, 'Test1', 'Test1', 'Test1', '2020-01-01', '12:00:00');
INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (1, 'Test2', 'Test2', 'Test2', '2020-01-01', '12:00:00');
INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (1, 'Test3', 'Test3', 'Test3', '2020-01-01', '12:00:00');
INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (2, 'Test4', 'Test4', 'Test4', '2020-01-01', '12:00:00');
INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (2, 'Test5', 'Test5', 'Test5', '2020-01-01', '12:00:00');
INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (3, 'Test6', 'Test6', 'Test6', '2020-01-01', '12:00:00');
INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (3, 'Test7', 'Test7', 'Test7', '2020-01-01', '12:00:00');
