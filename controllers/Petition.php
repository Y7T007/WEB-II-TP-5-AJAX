<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';


use models\Petition;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'] ?? '';
    $theme = $_POST['theme'] ?? '';
    $description = $_POST['description'] ?? '';
    $datePublic = $_POST['datePublic'] ?? '';
    $dateFin = $_POST['dateFin'] ?? '';

    $result = Petition::createPetition($titre, $theme, $description, $datePublic, $dateFin);

    if ($result['status'] === 'OK') {
        // Redirect to the list of petitions
        header('Location: ..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'ListePetitions.php');
    } else {
        // Display an error message
        echo $result['message'];
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['action'] == 'getMostSigned') {
    $petition = Petition::getMostSignedPetition();
    echo json_encode(array(
        'IDP' => $petition->getIDP(),
        'Titre' => $petition->getTitre(),
        'Theme' => $petition->getTheme(),
        'Description' => $petition->getDescription(),
        'DatePublic' => $petition->getDatePublic(),
        'DateFin' => $petition->getDateFin(),
        'SignatureCount' => $petition->getSignatureCount()
    ));
} elseif ($_GET['action'] == 'getAll') {
    $petitions = Petition::getAllPetitions();
    $petitionsArray = array_map(function($petition) {
        return array(
            'IDP' => $petition->getIDP(),
            'Titre' => $petition->getTitre(),
            'Theme' => $petition->getTheme(),
            'Description' => $petition->getDescription(),
            'DatePublic' => $petition->getDatePublic(),
            'DateFin' => $petition->getDateFin()
        );
    }, $petitions);
    echo json_encode($petitionsArray);
}else {
    // Display an error message
    echo 'Invalid request';
}