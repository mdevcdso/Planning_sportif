<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un match</title>
    <link rel="stylesheet" href="../vue/styles.css">
</head>
<body>
    <h1>Ajouter un match</h1>
    <form action="../controleur/ajouter_match_controller.php" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" required><br>

        <label for="duree">Durée :</label>
        <input type="time" name="duree" required><br>

        <label for="heure_match">Heure du match :</label>
        <input type="time" name="heure_match"><br>

        <label for="lieu_match">Lieu :</label>
        <input type="text" name="lieu_match"><br>

        <label for="description_match">Description :</label>
        <textarea name="description_match" rows="4" cols="50"></textarea><br>

        <label for="score">Score :</label>
        <input type="number" name="score" required><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
