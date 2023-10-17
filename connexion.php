<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion BDD</title>

    <link rel="stylesheet" href="planning.html">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-image: url(/img/fond-noir.jpg);">
    <h1>Résultats de la base de données</h1>

    <?php
        //Configuration de la connexion a la bdd
        $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $bdd = "planning";

        $estConnecte = false;

        //Etape 2 : Etablir la connexion
        try 
        {
            $connexion = new PDO("mysql:host=$serveur;dbname=$bdd",$utilisateur,$motDePasse);
        } catch(PDOException $e) {
            die("Erreur de connexion : ".$e->getMessage());
        }

        //Requêtes SQL SELECT
        $query = $connexion->prepare("SELECT * FROM utilisateurs");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $email = $_POST["email"];
        $mdp = $_POST["Mdp"];

        if(count($results)>0) 
        {
            echo "<ul>";
            foreach($results as $utilisateur) 
            {
                if($email == $utilisateur['email_utilisateur'] && $motDePasse == $utilisateur['mot_de_passe'])
                {
                    $estConnecte = true;
                }

                if($estConnecte)
                {
                    echo 'Connexion réussie !!';
                } else 
                {
                    echo 'Echec lors de la connexion.';
                }
            }
        } else
        {
            echo "<p>Aucun résultat trouvé.<p>";
        }

        //Etape 4 : Fermeture de la connexion à la base de données
        $connexion = null;
    ?>

</body>
</html>