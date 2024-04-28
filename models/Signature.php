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
    public static function getLastFiveSignatures(): array
    {
        global $conn;
        require __DIR__ . './../config.php';

        $sql = "SELECT * FROM Signature ORDER BY Date DESC, Heure DESC LIMIT 5";
        $result = $conn->query($sql);

        $signatures = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $signature = new Signature(
                    $row["IDP"],
                    $row["IDS"],
                    $row["Nom"],
                    $row["Prenom"],
                    $row["Pays"],
                    $row["Date"],
                    $row["Heure"]
                );
                $signatures[] = $signature->toArray();
            }
        }

        $conn->close();

        return $signatures;
    }
    public static function getLastFiveSignaturesByPetition($IDP): array
    {
        global $conn;
        require __DIR__ . './../config.php';

        $sql = "SELECT * FROM Signature WHERE IDP = ? ORDER BY Date DESC, Heure DESC LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $IDP);
        $stmt->execute();
        $result = $stmt->get_result();

        $signatures = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $signature = new Signature(
                    $row["IDP"],
                    $row["IDS"],
                    $row["Nom"],
                    $row["Prenom"],
                    $row["Pays"],
                    $row["Date"],
                    $row["Heure"]
                );
                $signatures[] = $signature->toArray();
            }
        }

        $stmt->close();
        $conn->close();

        return $signatures;
    }
    public function toArray() {
        return [
            'IDP' => $this->getIDP(),
            'Nom' => $this->getNom(),
            'Prenom' => $this->getPrenom(),
            'Pays' => $this->getPays(),
            'Date' => $this->getDate(),
            'Heure' => $this->getHeure(),
        ];
    }


}