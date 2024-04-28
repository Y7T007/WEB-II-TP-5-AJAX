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

    }

}