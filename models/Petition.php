<?php

namespace models;

class Petition {
    private $IDP;
    private $Titre;
    private $Theme;
    private $Description;
    private $DatePublic;
    private $DateFin;

    public function __construct($IDP, $Titre, $Theme, $Description, $DatePublic, $DateFin) {
        $this->IDP = $IDP;
        $this->Titre = $Titre;
        $this->Theme = $Theme;
        $this->Description = $Description;
        $this->DatePublic = $DatePublic;
        $this->DateFin = $DateFin;
    }

    public static function getAllPetitions()
    {
        global $conn;
        $sql = "SELECT * FROM Petition";
        $result = $conn->query($sql);
        $petitions = [];
        if ($result === false) {
            // The SQL query failed. Print the error message.
            echo "Error: " . $conn->error;
        } else if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $petitions[] = new Petition($row["IDP"], $row["Titre"], $row["Theme"], $row["Description"], $row["DatePublic"], $row["DateFin"]);
            }
        }
        return $petitions;
    }

    public function getIDP() {
        return $this->IDP;
    }

    public function getTitre() {
        return $this->Titre;
    }

    public function getTheme() {
        return $this->Theme;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function getDatePublic() {
        return $this->DatePublic;
    }

    public function getDateFin() {
        return $this->DateFin;
    }

    public function setIDP($IDP) {
        $this->IDP = $IDP;
    }

    public function setTitre($Titre) {
        $this->Titre = $Titre;
    }

    public function setTheme($Theme) {
        $this->Theme = $Theme;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
    }

    public function setDatePublic($DatePublic) {
        $this->DatePublic = $DatePublic;
    }

    public function setDateFin($DateFin) {
        $this->DateFin = $DateFin;
    }

    public function __toString() {
        return "IDP : " . $this->IDP . " Titre : " . $this->Titre . " Theme : " . $this->Theme . " Description : " . $this->Description . " DatePublic : " . $this->DatePublic . " DateFin : " . $this->DateFin;
    }

}