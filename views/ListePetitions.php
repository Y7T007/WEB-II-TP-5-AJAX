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
    <title> Liste des Pétitions</title>
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
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.misdeliver.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<h1>Liste des Pétitions</h1>
<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">IDP</th>
            <th scope="col">Titre</th>
            <th scope="col">Theme</th>
            <th scope="col">Description</th>
            <th scope="col">DatePublic</th>
            <th scope="col">DateFin</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($petitions as $petition): ?>

            <tr>
                <th scope="row"><?php echo $petition->getIDP(); ?></th>
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

        </tbody>
    </table>

    <h3>The most Signed Petition is :</h3>
    <p id="most-signed-petition"></p>


</div>

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

<script>

    function MostSignedPetition() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../controllers/Petition.php?action=getMostSigned', true);
        xhr.onload = function() {
            if (this.status == 200) {
                console.log(this)
                var petition = JSON.parse(this.responseText);
                var message = document.getElementById('most-signed-petition');
                message.textContent = 'The most signed petition is: ' + petition.IDP
                    + ', Title: ' + petition.Titre
                    + ', Theme: ' + petition.Theme
                    + ', Description: ' + petition.Description
                    + ', Public Date: ' + petition.DatePublic
                    + ', End Date: ' + petition.DateFin;
                document.body.appendChild(message);


            }
        };
        xhr.send();
    }
    MostSignedPetition();

    setInterval(MostSignedPetition, 2000);
</script>


<script>


    setInterval(function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../controllers/Signature.php?action=getLastFive', true);
        xhr.onload = function() {
            console.log(this)
            if (this.status === 200) {
                var signatures = JSON.parse(this.responseText);
                var textarea = document.getElementById('last-signatures');
                textarea.value = signatures.map(function(signature) {
                    return 'IDP: ' + signature.IDP
                        + ', IDS: ' + signature.IDS
                        + ', Nom: ' + signature.Nom
                        + ', Prenom: ' + signature.Prenom
                        + ', Pays: ' + signature.Pays
                        + ', Date: ' + signature.Date
                        + ', Heure: ' + signature.Heure;
                }).join('\n');
            }
        };
        xhr.send();
    }, 2000);

    document.querySelectorAll('.sign-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.nextElementSibling;
            form.style.display = 'block';

            var IDP = this.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent;

            var signaturesDiv = document.createElement('div');
            form.parentNode.appendChild(signaturesDiv);

            var loadSignatures = function() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '../controllers/Signature.php?action=getLastFiveByPetition&IDP=' + IDP, true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        var signatures = JSON.parse(this.responseText);

                        signaturesDiv.innerHTML = '';

                        signatures.forEach(function(signature) {
                            var p = document.createElement('p');
                            p.textContent = 'IDP: ' + signature.IDP
                                + ', Nom: ' + signature.Nom
                                + ', Prenom: ' + signature.Prenom
                                + ', Pays: ' + signature.Pays
                                + ', Date: ' + signature.Date
                                + ', Heure: ' + signature.Heure;
                            signaturesDiv.appendChild(p);
                        });
                    }
                };
                xhr.send();
            };

            loadSignatures();

            setInterval(loadSignatures, 2000);
        });
    });
</script>


</body>
</html>