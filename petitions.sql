

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