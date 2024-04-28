<!-- views/CreatePetition.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create a Petition</title>
</head>
<body>
<h1>Create a Petition</h1>

<form action="../controllers/Petition.php" method="post">
    <label for="titre">Titre:</label><br>
    <input type="text" id="titre" name="titre"><br>
    <label for="theme">Theme:</label><br>
    <input type="text" id="theme" name="theme"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <label for="datePublic">Date Public:</label><br>
    <input type="date" id="datePublic" name="datePublic"><br>
    <label for="dateFin">Date Fin:</label><br>
    <input type="date" id="dateFin" name="dateFin"><br>
    <input type="submit" value="Create">
</form>

</body>
</html>