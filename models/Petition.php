<?php

namespace models;

class Petition {
    private $IDP;
    private $Titre;
    private $Theme;
    private $Description;
    private $DatePublic;
    private $DateFin;
    private $SignatureCount;

    public function __construct($IDP, $Titre, $Theme, $Description, $DatePublic, $DateFin, $SignatureCount = 0) {
        $this->IDP = $IDP;
        $this->Titre = $Titre;
        $this->Theme = $Theme;
        $this->Description = $Description;
        $this->DatePublic = $DatePublic;
        $this->DateFin = $DateFin;
        $this->SignatureCount = $SignatureCount;
    }

    public static function getAllPetitions()
    {
        global $conn;
        require __DIR__ .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';

        $sql = "SELECT * FROM Petition";
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

    public static function createPetition(mixed $titre, mixed $theme, mixed $description, mixed $datePublic, mixed $dateFin)
    {

        global $conn;
        require __DIR__ .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';

        $sql = "INSERT INTO Petition (Titre, Theme, Description, DatePublic, DateFin) VALUES ('$titre', '$theme', '$description', '$datePublic', '$dateFin')";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            return ['status' => 'OK'];
        } else {
            $conn->close();
            return ['status' => 'ERROR', 'message' => 'Error: ' . $sql . '<br>' . $conn->error];
        }
    }
    // models/Petition.php
    public static function getMostSignedPetition()
    {
        global $conn;
        require __DIR__ .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';

        $sql = "SELECT Petition.*, COUNT(Signature.IDS) as SignatureCount FROM Petition LEFT JOIN Signature ON Petition.IDP = Signature.IDP GROUP BY Petition.IDP ORDER BY SignatureCount DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Petition(
                $row["IDP"],
                $row["Titre"],
                $row["Theme"],
                $row["Description"],
                $row["DatePublic"],
                $row["DateFin"],
                $row["SignatureCount"]
            );
        }

        $conn->close();

        return $result['SignatureCount'];
    }

    public function getIDP()
    {
        return $this->IDP;
    }

    public function setIDP($IDP)
    {
        $this->IDP = $IDP;
    }

    public function getTitre()
    {
        return $this->Titre;
    }

    public function setTitre($Titre)
    {
        $this->Titre = $Titre;
    }

    public function getTheme()
    {
        return $this->Theme;
    }

    public function setTheme($Theme)
    {
        $this->Theme = $Theme;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    public function getDatePublic()
    {
        return $this->DatePublic;
    }

    public function setDatePublic($DatePublic)
    {
        $this->DatePublic = $DatePublic;
    }

    public function getDateFin()
    {
        return $this->DateFin;
    }

    public function setDateFin($DateFin)
    {
        $this->DateFin = $DateFin;
    }

    public function getSignatureCount()
    {
        return $this->SignatureCount;
    }

}