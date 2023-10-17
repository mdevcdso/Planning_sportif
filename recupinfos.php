<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoFormulaire</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="formulaire.php">
</head>
<body>
    <div class="infos">
        <h1>
            Informations concernant le formulaire
        </h1>
        <div class="donnees">
            <?php
                echo 'Prénom : ' . $_POST["prenom"] . '<br>';
                echo 'Nom : ' . $_POST["nom"] . '<br>';
                echo 'Genre : ' . $_POST["genre"] . '<br>';
                echo 'Adresse email : ' . $_POST["email"] . '<br>';
                echo 'Rôle : ' . $_POST["role"] . '<br>';
                echo 'Mot de passe : ' . $_POST["Mdp"] . '<br>';

                $serveur = "localhost"; // Adresse du serveur MySQL
                $utilisateur = "root"; // Nom d'utilisateur MySQL
                $motdepasse = ""; // Mot de passe MySQL
                $base_de_donnees = "planning"; // Nom de la base de données

                // Connexion à la base de données
                $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

                // Vérification de la connexion
                if ($connexion->connect_error) {
                    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
                }

                // Récupération des données du formulaire
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $genre = $_POST["genre"];
                    $email = $_POST["email"];
                    $role = $_POST["role"];
                    $mdp = $_POST["Mdp"];

                    // Requête SQL pour insérer les données dans la table "utilisateur"
                    $requete = "INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, genre_utilisateur, email_utilisateur, mot_de_passe, role) VALUES ('$nom', '$prenom', '$genre', '$email', '$mdp', $role)";

                    // Exécution de la requête
                    if ($connexion->query($requete) === TRUE) {
                        echo "Données insérées avec succès.";
                    } else {
                        echo "Erreur lors de l'insertion des données : " . $connexion->error;
                    }

                    // Fermeture de la connexion à la base de données
                    $connexion->close();
                }
            ?>
        </div>
        <a href="planning.html" class="continuer">
            <button>
                Continuer
            </button>
        </a>
    </div>
</body>
</html>