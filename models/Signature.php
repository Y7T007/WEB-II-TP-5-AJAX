<?php

namespace models;


class Signature {
    private $IDP;
    private $IDS;
    private $Nom;
    private $Prenom;
    private $Pays;
    private $Date;
    private $Heure;


    public function __construct($IDP, $IDS, $Nom, $Prenom, $Pays, $Date, $Heure) {
        $this->IDP = $IDP;
        $this->IDS = $IDS;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->Pays = $Pays;
        $this->Date = $Date;
        $this->Heure = $Heure;
    }

    public function getIDP() {
        return $this->IDP;
    }

    public function getIDS() {
        return $this->IDS;
    }

    public function getNom() {
        return $this->Nom;
    }

    public function getPrenom() {
        return $this->Prenom;
    }

    public function getPays() {
        return $this->Pays;
    }

    public function getDate() {
        return $this->Date;
    }

    public function getHeure() {
        return $this->Heure;
    }

    public function setIDP($IDP) {
        $this->IDP = $IDP;
    }

    public function setIDS($IDS) {
        $this->IDS = $IDS;
    }

    public function setNom($Nom) {
        $this->Nom = $Nom;
    }

    public function setPrenom($Prenom) {
        $this->Prenom = $Prenom;
    }

    public function setPays($Pays) {
        $this->Pays = $Pays;
    }

    public function setDate($Date) {
        $this->Date = $Date;
    }

    public function setHeure($Heure) {
        $this->Heure = $Heure;
    }
    public static function getLastFiveSignatures()
    {
        global $conn;
        require __DIR__ . './../config.php';

        $sql = "SELECT Petition.*, COUNT(Signature.IDS) as SignatureCount FROM Petition LEFT JOIN Signature ON Petition.IDP = Signature.IDP GROUP BY Petition.IDP ORDER BY SignatureCount DESC LIMIT 5";
        $result = $conn->query($sql);

        $petitions = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $petitions[] = new Petition(
                    $row["IDP"],
                    $row["Titre"],
                    $row["Theme"],
                    $row["Description"],
                    $row["DatePublic"],
                    $row["DateFin"]
                );
            }
        }

        $conn->close();

        return $petitions;
    }


}