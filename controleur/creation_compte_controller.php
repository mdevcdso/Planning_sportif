<?php
// create_account_controller.php
require_once '../modele/config.php';
require_once '../modele/planning.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];
    $role = $_POST['role'];
    $sport = $_POST["sport"];

    // Créer une instance de la classe Utilisateur et insérer les données dans la base de données
    // Requête insertion bdd
    if (!empty($email) && !empty($mdp) && !empty($nom) && !empty($confirmerMotDePasse) && !empty($prenom)) {
        // Valider les mots de passe
        if ($mdp !== $confirmerMotDePasse) {
            // Les mots de passe ne correspondent pas, rediriger avec un message d'erreur
            header('Location: ../vue/creation_compte.php?error=1');
            exit();
        }
        
        try {
            $mdpHash  = password_hash($mdp, PASSWORD_DEFAULT); // Hasher le mot de passe

            $requete = $connexion->prepare("INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, genre_utilisateur, email_utilisateur, mot_de_passe, role)VALUES (:nom, :prenom, :genre, :email, :mdp, :role)");
            $requete->execute([
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":genre" => $genre,
                ":email" => $email,
                ":mdp" => $mdpHash,
                ":role" => $role
            ]);

            // Insérer la valeur de $sport dans la table compte
            if (!empty($sport)) {
                $sql = "SELECT id_utilisateur FROM utilisateurs ORDER BY id_utilisateur DESC LIMIT 1";
                $result = $connexion->query($sql);

                if ($result->rowCount() > 0) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);
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
                $id_compte = $connexion->lastInsertId();

                $requeteSport = $connexion->prepare("SELECT Id_Sport FROM Sport WHERE nom_sport = :nom_sport");
                $requeteSport->execute([":nom_sport" => $sport]);
                $resultSport = $requeteSport->fetch(PDO::FETCH_ASSOC);
                if ($resultSport) {
                    $id_sport = $resultSport['Id_Sport'];
                } else {
                    echo "Aucun sport trouvé.";
                }

                $requetePlanning = $connexion->prepare("INSERT INTO planning (id_utilisateur)VALUES (:id_utilisateur)");
                $requetePlanning->execute([
                    ":id_utilisateur" => $id_utilisateur
                ]);
                $id_planning = $connexion->lastInsertId();


                $requetePosseder = $connexion->prepare("INSERT INTO posséder (id_compte, id_planning) VALUES (:id_compte, :id_planning)");
                $requetePosseder->execute([
                    ":id_compte" => $id_compte,
                    ":id_planning" => $id_planning
                ]);

                $requeteAssocier = $connexion->prepare("INSERT INTO associer (id_compte, Id_Sport) VALUES (:id_compte, :Id_Sport)");
                $requeteAssocier->execute([
                    ":id_compte" => $id_compte,
                    ":Id_Sport" => $id_sport 
                ]);

                // Vérifiez si l'insertion s'est effectuée avec succès
                if ($requeteAssocier) {
                    // Rediriger vers la page de connexion après la création du compte
                    header('Location: ../vue/connexion.php');
                    exit();
                } else {
                    echo "Erreur lors de l'insertion des données dasn la table posseder : " . $requeteCompte->errorInfo()[2];
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
            $connexion = null;
        } catch (PDOException $e) {
            die("Erreur lors de l'insertion des données : " . $e->getMessage());
        }
    } else {
        $errors[] = '<font color="red">Attention, Aucun champs ne doit être vide!</font>';
    }
}
?>
