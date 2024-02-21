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
                // Connexion à la base de données
                require "../modele/database.php";

                echo 'Prénom : ' . $_POST["prenom"] . '<br>';
                echo 'Nom : ' . $_POST["nom"] . '<br>';
                echo 'Genre : ' . $_POST["genre"] . '<br>';
                echo 'Adresse email : ' . $_POST["email"] . '<br>';
                echo 'Rôle : ' . $_POST["role"] . '<br>';
                echo 'Sport choisi : ' . $_POST["sport"] . '<br>';
                echo 'Mot de passe : ' . $_POST["Mdp"] . '<br>';

                // Récupération des données du formulaire
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $genre = $_POST["genre"];
                    $email = $_POST["email"];
                    $role = $_POST["role"];
                    $sport = $_POST["sport"];
                    $mdp = $_POST["Mdp"];

                    // Masquer le mot de passe
                    $hash = password_hash($mdp, PASSWORD_DEFAULT);

                    // Requête insertion bdd
                    if (!empty($email) && !empty($mdp) && !empty($nom) && !empty($prenom)) {
                        $requete = $connexion->prepare("INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, genre_utilisateur, email_utilisateur, mot_de_passe, role)VALUES (:nom, :prenom, :genre, :email, :mdp, :role)");
                        $requete->execute([
                            ":nom" => $nom,
                            ":prenom" => $prenom,
                            ":genre" => $genre,
                            ":email" => $email,
                            ":mdp" => $hash,
                            ":role" => $role
                        ]);
                    } else {
                        $errors[] = '<font color="red">Attention, Aucun champs ne doit être vide!</font>';
                    }

                    // Insérer la valeur de $sport dans la table compte
                    if (!empty($sport)) {
                        $sql = "SELECT id_utilisateur FROM utilisateurs ORDER BY id_utilisateur DESC LIMIT 1";
                        $result = $connexion->query($sql);

                        if ($result->rowCount() > 0) {
                            $row = $result->fetch();
                            $id_utilisateur = $row["id_utilisateur"];
                            echo "La dernière valeur d'id_utilisateur est : " . $id_utilisateur;
                        } else {
                            echo "Aucun résultat trouvé.";
                        }
                        
                        $requeteCompte = $connexion->prepare("INSERT INTO compte (sport_choisi, id_utilisateur) VALUES (:sport, :id_utilisateur)");
                        $requeteCompte->execute([
                            ":sport" => $sport,
                            ":id_utilisateur" => $id_utilisateur
                        ]);

                        // Vérifiez si l'insertion s'est effectuée avec succès
                        if ($requeteCompte) {
                            echo ". Sport choisi inséré avec succès dans la table compte.";
                        } else {
                            echo "Erreur lors de l'insertion du sport choisi : " . $connexion->error;
                        }
                    } else {
                        echo "Le champ sport est vide, veuillez le remplir.";
                    }

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
        <a href="../vue/planning.php" class="continuer">
            <button>
                Continuer
            </button>
        </a>
    </div>
</body>
</html>