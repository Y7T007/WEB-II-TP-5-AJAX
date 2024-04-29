

<form class="signature-form" action="../controllers/Signature.php" method="post">
    <input type="hidden" name="petition" value="<?php echo $petition->getIDP(); ?>">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom">
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <label for="pays">Pays:</label>
    <input type="text" id="pays" name="pays">

    <input type="submit" value="Envoyer">
</form>