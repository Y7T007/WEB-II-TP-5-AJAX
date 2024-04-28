

<form class="signature-form" action="../controllers/Signature.php" method="post">
    <input type="hidden" name="petition" value="<?php echo $petition->getIDP(); ?>">
    <label for="nom">Nom:</label><br>
    <input type="text" id="nom" name="nom"><br>
    <label for="prenom">Prénom:</label><br>
    <input type="text" id="prenom" name="prenom"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="pays">Pays:</label><br>
    <input type="text" id="pays" name="pays"><br>
    <textarea id="last-signatures" readonly></textarea>

    <input type="submit" value="Envoyer">
</form>