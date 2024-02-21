<!-- supprimer_match.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un match</title>
    <link rel="stylesheet" href="../vue/styles.css">
</head>
<body>
    <h1>Supprimer un match</h1>
    <form action="../controleur/supprimer_match_controller.php" method="POST">
        <!-- Ajoutez ici les champs nécessaires pour supprimer un match -->
        <label for="id_match">ID du match à supprimer :</label>
        <input type="text" name="id_match" required><br>

        <input type="submit" value="Supprimer">
    </form>
</body>
</html>
