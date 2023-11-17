<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion BDD</title>

    <link rel="stylesheet" href="planning.php">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-image: url(/img/fond-noir.jpg);">
    <h1>Résultats de la base de données</h1>

    <?php
        //Etablir la connexion
        require "database.php";

        //Requêtes SQL SELECT
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $mdp = $_POST["Mdp"];

            // Requête SQL pour vérifier les informations de connexion
            $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = :email");
            $requete->execute([":email" => $email]);
            $utilisateur = $requete->fetch();
            
            if ($utilisateur && password_verify($mdp, $utilisateur["mot_de_passe"])) {
                header("Location: planning.php");
                exit;
            } else {
                echo '<font color="white">Échec de la connexion.</font>';
                var_dump($requete->errorInfo());
            }
        }

        //Etape 4 : Fermeture de la connexion à la base de données
        $connexion = null;
    ?>

</body>
</html>