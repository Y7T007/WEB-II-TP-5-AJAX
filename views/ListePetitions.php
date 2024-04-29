<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

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
<!--    <link rel="stylesheet" href="assets/css/Bootstrap-4---Table-Fixed-Header.css">-->
<!--    <link rel="stylesheet" href="assets/css/Card-Deck.css">-->
    <link rel="stylesheet" href="assets/css/Section-Title.css">

    <link rel="stylesheet" href="assets/css/Animation-Cards-_app.css">
    <link rel="stylesheet" href="assets/css/Animation-Cards.css">
</head>
<body>
<section class="bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-12" style="padding: 0px;background: url(assets/img/petition-scaled.jpg) center / contain no-repeat;border-radius: 20px;">
                <p><br><br><br><br><br><br><br><br><br><br><br><br><br></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-12">
                <div class="title-div" style="padding: 11px;margin: 18px;margin-right: auto;margin-left: auto;margin-top: 20px;margin-bottom: 20px;">
                    <h1>Petitions</h1>
                </div>
                <hr>
                <div style="text-align:center"></div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-7 mx-auto bg-white rounded shadow">


                <div class="table-responsive">
    <table class=" table table-fixed">
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
                    <button class="btn btn-primary sign-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Sign Petition</button>
                    <?php include 'SignatureForm.php'; ?>
                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>
    </table>
                    <!-- Add this button where you want it to appear -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPetitionModal">
                        Create Petition
                    </button>

                    <!-- Add this modal structure at the end of your body tag -->
                    <div class="modal fade" id="createPetitionModal" tabindex="-1" aria-labelledby="createPetitionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createPetitionModalLabel">Create a Petition</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- The content of CreatePetition.php will be loaded here -->
                                    <?php include 'CreatePetition.php';?>
                                    <script>
                                        document.querySelector('[data-bs-target="#createPetitionModal"]').addEventListener('click', function() {
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('GET', 'CreatePetition.php', true);
                                            xhr.onload = function() {
                                                if (this.status == 200) {
                                                    document.querySelector('#createPetitionModal .modal-body').innerHTML = this.responseText;
                                                }
                                            };
                                            xhr.send();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>


</div>



<div class="container d-flex justify-content-center align-items-center">
    <div class="container py-5">
        <div class="row" style="display: flex;flex-direction: row;justify-content: center;align-items: center">
            <h3 style="text-align: center">The most Signed Petition is :</h3>
            <p id="most-signed-petition"></p>

            <div class="card" style="width: 18rem;border-top-left-radius: 20px;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;box-shadow: 5px 5px 16px 2px rgba(0,0,0,0.25);margin: 14px;min-width: 280px;max-width: 300px;margin-bottom: 20px;">
                <div style="width:100%;height:200px;background:url('../assets/images/petition.jpg') center / contain;border-top-left-radius:20px;border-top-right-radius:20px;"></div>
                <div class="card-body d-flex flex-column" style="height: 262px;">
                    <div>
                        <h4 style="font-family: 'Source Sans Pro', sans-serif;font-weight: 700;color: rgb(255,160,0);">IDP # TITRE :</h4>
                        <h6 class="text-muted mb-2" style="font-family: 'Source Sans Pro', sans-serif;font-weight: 600;color: #757575;">Theme : </h6>
                        <p style="font-family: 'Source Sans Pro', sans-serif;color: #212121;margin-top: 16px;">Description:<br /> - Aplicativos Web<br />- Consultoria em TI</p>
                        <h6 class="text-muted mb-2" style="font-family: 'Source Sans Pro', sans-serif;font-weight: 600;color: #757575;">Date Public : </h6>
                        <h6 class="text-muted mb-2" style="font-family: 'Source Sans Pro', sans-serif;font-weight: 600;color: #757575;">Date Fin : </h6>
                        <h6 class="text-muted mb-2" style="font-family: 'Source Sans Pro', sans-serif;font-weight: 600;color: #757575;">Nb Signature:</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                var petition = JSON.parse(this.responseText);
                var card = document.querySelector('.card');
                card.querySelector('h4').textContent =  'IDP:'+petition.IDP+' # Titre: ' + petition.Titre;
                card.querySelector('h6:nth-child(2)').textContent = 'Theme: ' + petition.Theme;
                card.querySelector('p').textContent = 'Description: ' + petition.Description;
                card.querySelector('h6:nth-child(4)').textContent = 'Date Public: ' + petition.DatePublic;
                card.querySelector('h6:nth-child(5)').textContent = 'Date Fin: ' + petition.DateFin;
                // Assuming you have the number of signatures in your response
                card.querySelector('h6:nth-child(6)').textContent = 'Nb Signature: ' + petition.SignatureCount;
            }
        };
        xhr.send();
    }
    MostSignedPetition();

    setInterval(MostSignedPetition, 2000);
</script>


<script>


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
                            var card = document.createElement('div');
                            card.className = 'row space-rows';

                            var col = document.createElement('div');
                            col.className = 'col';

                            var cardDiv = document.createElement('div');
                            cardDiv.className = 'card-2 cards-shadown cards-hover';

                            var cardHeader = document.createElement('div');
                            cardHeader.className = 'card-header';

                            var cardHeaderText = document.createElement('div');
                            cardHeaderText.className = 'cardheader-text';

                            var h3 = document.createElement('h3');
                            h3.textContent = 'Signature';
                            
                            var h4 = document.createElement('h4');
                            h4.textContent = `Signature de M.  ` + signature.Nom;

                            var p = document.createElement('p');
                            p.textContent = 'Prenom: ' + signature.Prenom;

                            cardHeaderText.appendChild(h4);
                            cardHeaderText.appendChild(p);
                            cardHeader.appendChild(cardHeaderText);
                            cardDiv.appendChild(cardHeader);

                            var cardBody = document.createElement('div');
                            cardBody.className = 'card-body';

                            var pCountry = document.createElement('p');
                            pCountry.className = 'card-text sub-text-color';
                            pCountry.textContent = 'Pays: ' + signature.Pays;

                            var pDate = document.createElement('p');
                            pDate.className = 'cardbody-sub-text';
                            pDate.textContent = 'Date: ' + signature.Date;

                            cardBody.appendChild(pCountry);
                            cardBody.appendChild(pDate);
                            cardDiv.appendChild(cardBody);

                            col.appendChild(cardDiv);
                            card.appendChild(col);
                            signaturesDiv.appendChild(card);
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