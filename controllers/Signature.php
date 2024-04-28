<?php

global $conn;
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use models\Signature;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['petition'])) {
    $IDP = $_POST['petition'];
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $pays = $_POST['pays'] ?? '';

    $signature = new Signature($IDP, null, $nom, $prenom, $pays, date('Y-m-d'), date('H:i:s'));

    require __DIR__ .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';
    $sql = "INSERT INTO Signature (IDP, Nom, Prenom, Pays, Date, Heure) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $IDP = $signature->getIDP();
    $nom = $signature->getNom();
    $prenom = $signature->getPrenom();
    $pays = $signature->getPays();
    $date = $signature->getDate();
    $heure = $signature->getHeure();

    $stmt->bind_param("isssss", $IDP, $nom, $prenom, $pays, $date, $heure);
    $stmt->execute();

    if ($stmt->error) {
        echo json_encode(['status' => 'notOK', 'message' => $stmt->error]);
    } else {
        echo json_encode(['status' => 'OK', 'message' => 'New record created successfully']);
    }

    $stmt->close();
    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['action'] == 'getLastFive') {
    $signatures = Signature::getLastFiveSignatures();
    echo json_encode($signatures);
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['action'] == 'getLastFiveByPetition') {
    $IDP = $_GET['IDP'];
    $signatures = Signature::getLastFiveSignaturesByPetition($IDP);
    echo json_encode($signatures);
}else {
    echo json_encode(['status' => 'notOK', 'message' => 'Invalid request']);
}