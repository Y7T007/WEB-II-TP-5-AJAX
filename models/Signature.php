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

    public function __toString() {
        return $this->Nom . " " . $this->Prenom . " (" . $this->Pays . ")";
    }

}