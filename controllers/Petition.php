<?php

require __DIR__ . './../vendor/autoload.php';

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
        header('Location: ../views/ListePetitions.php');
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
        'DateFin' => $petition->getDateFin()
    ));
} else {
    // Display an error message
    echo 'Invalid request';
}