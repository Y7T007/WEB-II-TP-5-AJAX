<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . './../vendor/autoload.php';


use models\Petition;

$petitions = Petition::getAllPetitions();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Pétitions</title>
</head>
<body>
<h1>Liste des Pétitions</h1>

<table>
    <tr>
        <th>IDP</th>
        <th>Titre</th>
        <th>Theme</th>
        <th>Description</th>
        <th>DatePublic</th>
        <th>DateFin</th>
    </tr>

    <?php foreach ($petitions as $petition): ?>

        <tr>
            <td><?php echo $petition->getIDP(); ?></td>
            <td><?php echo $petition->getTitre(); ?></td>
            <td><?php echo $petition->getTheme(); ?></td>
            <td><?php echo $petition->getDescription(); ?></td>
            <td><?php echo $petition->getDatePublic(); ?></td>
            <td><?php echo $petition->getDateFin(); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>