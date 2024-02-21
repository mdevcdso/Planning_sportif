<!-- modifier_match.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un match</title>
    <link rel="stylesheet" href="../vue/styles.css">
</head>
<body>
    <h1>Modifier un match</h1>
    <form action="../controleur/modifier_match_controller.php" method="POST">
        <!-- Ajoutez ici les champs nécessaires pour modifier un match -->
        <label for="id_match">ID du match à modifier :</label>
        <input type="text" name="id_match" required><br>

        <!-- Ajoutez d'autres champs selon vos besoins -->

        <input type="submit" value="Modifier">
    </form>
</body>
</html>
