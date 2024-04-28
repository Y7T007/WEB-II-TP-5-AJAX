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
    <style>
        .signature-form {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #000;
            animation: slideDown 0.5s forwards;
        }

        @keyframes slideDown {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(0); }
        }
    </style>
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
        <th>Action</th>
    </tr>

    <?php foreach ($petitions as $petition): ?>

        <tr>
            <td><?php echo $petition->getIDP(); ?></td>
            <td><?php echo $petition->getTitre(); ?></td>
            <td><?php echo $petition->getTheme(); ?></td>
            <td><?php echo $petition->getDescription(); ?></td>
            <td><?php echo $petition->getDatePublic(); ?></td>
            <td><?php echo $petition->getDateFin(); ?></td>
            <td>
                <button class="sign-button">Sign Petition</button>
                <?php include 'SignatureForm.php'; ?>

            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    document.querySelectorAll('.sign-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.nextElementSibling;
            form.style.display = 'block';
        });
    });
</script>

<script>
    document.querySelectorAll('.sign-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.nextElementSibling;
            form.style.display = 'block';
        });
    });

    document.querySelectorAll('.signature-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/Signature.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var message = document.createElement('p');
                    message.textContent = response.status;
                    form.parentNode.appendChild(message);
                }
            };

            var data = new FormData(form);
            xhr.send(new URLSearchParams(data).toString());
        });
    });
</script>

</body>
</html>