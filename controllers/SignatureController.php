<?php

global $conn;
require __DIR__ . './../vendor/autoload.php';

use models\Signature;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['petition'])) {
    $IDP = $_POST['petition'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pays = $_POST['pays'];

    $signature = new Signature($IDP, null, $nom, $prenom, $pays, date('Y-m-d'), date('H:i:s'));

    require __DIR__ . './../config.php';
    $sql = "INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $signature->getIDP(), $signature->getNom(), $signature->getPrenom(), $signature->getPays(), $signature->getDate(), $signature->getHeure());
    $stmt->execute();

    if ($stmt->error) {
        echo "ERROR: " . $stmt->error;
    } else {
        echo "New record created successfully";
    }

    $stmt->close();
    $conn->close();

    header('Location: ../views/ListePetitions.php');
} else {
    header('Location: ../views/ListePetitions.php');
}