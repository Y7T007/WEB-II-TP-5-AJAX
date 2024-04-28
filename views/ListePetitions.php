<?php


require_once 'models/Petition.php';

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
            <td><?= $petition->getIDP() ?></td>
            <td><?= $petition->getTitre() ?></td>
            <td><?= $petition->getTheme() ?></td>
            <td><?= $petition->getDescription() ?></td>
            <td><?= $petition->getDatePublic() ?></td>
            <td><?= $petition->getDateFin() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>