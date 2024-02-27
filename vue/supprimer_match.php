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

    <form action="../controleur/supprimer_match_controller.php" method="post">
        <label for="match">Sélectionner le match à supprimer :</label>
        <select name="match_id" id="match_id">
            <?php
                require_once '../modele/matchs.php';
                $matchs = Matchs::getMatchs();
                foreach ($matchs as $match) {
                    echo "<option value='{$match['Id_Matchs']}'>{$match['titre']}</option>";
                }            
            ?>
        </select>

        <input type="submit" value="Supprimer le match">
    </form>
</body>
</html>
