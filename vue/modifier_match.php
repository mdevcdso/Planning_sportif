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
        <label for="match_id">Sélectionnez le match à modifier :</label>
        <select name="match_id" id="match_id">
            <!-- Afficher la liste des matchs existants -->
            <?php
            require_once '../modele/matchs.php';
            $matchs = Matchs::getMatchs();
            foreach ($matchs as $match) {
                echo "<option value='{$match['Id_Matchs']}'>{$match['titre']}</option>";
            }            
            ?>
        </select>

        <!-- Ajoutez ici les champs nécessaires pour modifier un match -->
        <!-- Par exemple : -->
        <label for="nouveau_titre">Nouveau titre :</label>
        <input type="text" name="nouveau_titre">

        <label for="nouvelle_duree">Nouvelle durée :</label>
        <input type="time" name="nouvelle_duree">

        <label for="nouvelle_date">Nouvelle date :</label>
        <input type="datetime-local" name="nouvelle_date">

        <label for="nouveau_lieu">Nouveau lieu :</label>
        <input type="text" name="nouveau_lieu">

        <label for="nouvelle_description">Nouvelle description :</label>
        <input type="text" name="nouvelle_description">

        <label for="nouveau_score">Nouveau score :</label>
        <input type="number" name="nouveau_score">

        <input type="submit" value="Modifier">
    </form>
</body>
</html>
