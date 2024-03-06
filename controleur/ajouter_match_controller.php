<?php
require_once '../modele/config.php';

// Démarrez la session avant d'accéder à $_SESSION
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

    // Assurez-vous que la session est démarrée avant d'accéder à $_SESSION
    if (isset($_SESSION['email_utilisateur'])) {
        $email_utilisateur = $_SESSION['email_utilisateur'];

        // Recherche de l'ID utilisateur correspondant à l'adresse e-mail
        $queryUtilisateur = "SELECT id_utilisateur FROM utilisateurs WHERE email_utilisateur = :email_utilisateur";
        $stmtUtilisateur = $bdd->prepare($queryUtilisateur);
        $stmtUtilisateur->bindParam(':email_utilisateur', $email_utilisateur);
        $stmtUtilisateur->execute();
        $resultUtilisateur = $stmtUtilisateur->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si l'ID utilisateur a été récupéré avec succès
        if ($resultUtilisateur) {
            $id_utilisateur = $resultUtilisateur['id_utilisateur'];

            // Récupérez les données du formulaire
            $titre = $_POST['titre'];
            $duree = $_POST['duree'];
            $date_match = $_POST['date_match'];
            $lieu_match = $_POST['lieu_match'];
            $description_match = $_POST['description_match'];
            $score = $_POST['score'];

            try {

                // Insertion des informations du match
                $query = "INSERT INTO matchs (titre, duree, date_match, lieu_match, description_match, score, id_utilisateur) VALUES (:titre, :duree, :date_match, :lieu_match, :description_match, :score, :id_utilisateur)";
                $stmt = $bdd->prepare($query);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':duree', $duree);
                $stmt->bindParam(':date_match', $date_match);
                $stmt->bindParam(':lieu_match', $lieu_match);
                $stmt->bindParam(':description_match', $description_match);
                $stmt->bindParam(':score', $score);
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->execute();
                $lastInsertedMatchId = $bdd->lastInsertId();


            } catch (PDOException $e) {
                // Gérez les erreurs liées à la base de données ici
                echo "Erreur : " . $e->getMessage() . "<br>";
        
                // Informations détaillées sur l'erreur SQL
                $errorInfo = $stmt->errorInfo();
                echo "Code d'erreur SQL : " . $errorInfo[0] . "<br>";
                echo "Code d'erreur du pilote : " . $errorInfo[1] . "<br>";
                echo "Message d'erreur du pilote : " . $errorInfo[2] . "<br>";
                die;
            }

            header('Location: ../vue/planning.php');
            exit();
        } else {
            echo "L'ID de l'utilisateur n'a pas pu être récupéré.";
        }
    } else {
        echo "La session n'est pas démarrée.";
    }
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Récupérez les données du formulaire
//     $titre = $_POST['titre'];
//     $duree = $_POST['duree'];
//     $date_match = $_POST['date_match'];
//     $lieu_match = $_POST['lieu_match'];
//     $description_match = $_POST['description_match'];
//     $score = $_POST['score'];

//     // Récupérez les données des équipes et joueurs
//     $equipe1 = $_POST['equipe1'];
//     $nombre_joueurs1 = $_POST['nombre_joueurs1'];
//     $nom_entraineur1 = $_POST['nom_entraineur1'];
//     $ratio1 = $_POST['ratio1'];
//     $nombre_victoire1 = $_POST['nombre_victoire1'];
//     $nombre_defaite1 = $_POST['nombre_defaite1'];

//     $equipe2 = $_POST['equipe2'];
//     $nombre_joueurs2 = $_POST['nombre_joueurs2'];
//     $nom_entraineur2 = $_POST['nom_entraineur2'];
//     $ratio2 = $_POST['ratio2'];
//     $nombre_victoire2 = $_POST['nombre_victoire2'];
//     $nombre_defaite2 = $_POST['nombre_defaite2'];

//     // Récupérez les données des joueurs de l'équipe 1
//     $joueurs_equipe1 = $_POST['joueur_equipe1'];
//     $details_joueurs1 = array_map('explode', array_fill(0, count($joueurs_equipe1), ','), $joueurs_equipe1);

//     // Récupérez les données des joueurs de l'équipe 2
//     $joueurs_equipe2 = $_POST['joueur_equipe2'];
//     $details_joueurs2 = array_map('explode', array_fill(0, count($joueurs_equipe2), ','), $joueurs_equipe2);

//     // Ajoutez la logique pour insérer le match dans la base de données
//     try {
//         $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

//         // Insertion des informations du match
//         $query = "INSERT INTO matchs (titre, duree, date_match, lieu_match, description_match, score) VALUES (:titre, :duree, :date_match, :lieu_match, :description_match, :score)";
//         $stmt = $bdd->prepare($query);
//         $stmt->bindParam(':titre', $titre);
//         $stmt->bindParam(':duree', $duree);
//         $stmt->bindParam(':date_match', $date_match);
//         $stmt->bindParam(':lieu_match', $lieu_match);
//         $stmt->bindParam(':description_match', $description_match);
//         $stmt->bindParam(':score', $score);
//         $stmt->execute();
//         $lastInsertedMatchId = $bdd->lastInsertId();

//         // // Insertion des équipes
//         $stmtEquipe1 = $bdd->prepare("INSERT INTO equipes (nom_equipe, nombre_joueurs, nom_entraineur, ratio, nombre_victoire, nombre_defaite) VALUES (:equipe1, :nombre_joueurs, :nom_entraineur, :ratio, :nombre_victoire, :nombre_defaite)");
//         $stmtEquipe1->bindParam(':equipe1', $equipe1);
//         $stmtEquipe1->bindParam(':nombre_joueurs', $nombre_joueurs1);
//         $stmtEquipe1->bindParam(':nom_entraineur', $nom_entraineur1);
//         $stmtEquipe1->bindParam(':ratio', $ratio1);
//         $stmtEquipe1->bindParam(':nombre_victoire', $nombre_victoire1);
//         $stmtEquipe1->bindParam(':nombre_defaite', $nombre_defaite1);
//         $stmtEquipe1->execute();
//         $idEquipe1 = $bdd->lastInsertId();

//         $stmtEquipe2 = $bdd->prepare("INSERT INTO equipes (nom_equipe, nombre_joueurs, nom_entraineur, ratio, nombre_victoire, nombre_defaite) VALUES (:equipe2, :nombre_joueurs, :nom_entraineur, :ratio, :nombre_victoire, :nombre_defaite)");
//         $stmtEquipe2->bindParam(':equipe2', $equipe2);
//         $stmtEquipe2->bindParam(':nombre_joueurs', $nombre_joueurs2);
//         $stmtEquipe2->bindParam(':nom_entraineur', $nom_entraineur2);
//         $stmtEquipe2->bindParam(':ratio', $ratio2);
//         $stmtEquipe2->bindParam(':nombre_victoire', $nombre_victoire2);
//         $stmtEquipe2->bindParam(':nombre_defaite', $nombre_defaite2);
//         $stmtEquipe2->execute();
//         $idEquipe2 = $bdd->lastInsertId();

//         // Insertion des joueurs pour l'équipe 1
//         for ($i = 0; $i < count($details_joueurs1); $i++) {
//             $stmtJoueur = $bdd->prepare("INSERT INTO joueurs (nom_joueurs, prenom_joueur, age_joueur, role, id_equipe) VALUES (:nom_joueur, :prenom_joueur, :age_joueur, :role, :id_equipe)");
//             $stmtJoueur->bindParam(':nom_joueur', $details_joueurs1[$i][0]);
//             $stmtJoueur->bindParam(':prenom_joueur', $details_joueurs1[$i][1]);
//             $stmtJoueur->bindParam(':age_joueur', $details_joueurs1[$i][2]);
//             $stmtJoueur->bindParam(':role', $details_joueurs1[$i][3]);
//             $stmtJoueur->bindParam(':id_equipe', $idEquipe1);
//             $stmtJoueur->execute();
//         }

//         // Insertion des joueurs pour l'équipe 2
//         for ($i = 0; $i < count($details_joueurs2); $i++) {
//             $stmtJoueur = $bdd->prepare("INSERT INTO joueurs (nom_joueurs, prenom_joueur, age_joueur, role, id_equipe) VALUES (:nom_joueur, :prenom_joueur, :age_joueur, :role, :id_equipe)");
//             $stmtJoueur->bindParam(':nom_joueur', $details_joueurs2[$i][0]);
//             $stmtJoueur->bindParam(':prenom_joueur', $details_joueurs2[$i][1]);
//             $stmtJoueur->bindParam(':age_joueur', $details_joueurs2[$i][2]);
//             $stmtJoueur->bindParam(':role', $details_joueurs2[$i][3]);
//             $stmtJoueur->bindParam(':id_equipe', $idEquipe2);
//             $stmtJoueur->execute();
//         }

//         // Insertion des équipes dans la table Participer
//         $stmtParticiper1 = $bdd->prepare("INSERT INTO participer (Id_Matchs, id_equipe) VALUES (:id_match, :id_equipe)");
//         $stmtParticiper1->bindParam(':id_match', $lastInsertedMatchId);
//         $stmtParticiper1->bindParam(':id_equipe', $idEquipe1);
//         $stmtParticiper1->execute();

//         $stmtParticiper2 = $bdd->prepare("INSERT INTO participer (Id_Matchs, id_equipe) VALUES (:id_match, :id_equipe)");
//         $stmtParticiper2->bindParam(':id_match', $lastInsertedMatchId);
//         $stmtParticiper2->bindParam(':id_equipe', $idEquipe2);
//         $stmtParticiper2->execute();

//     } catch (PDOException $e) {
//         // Gérez les erreurs liées à la base de données ici
//         echo "Erreur : " . $e->getMessage() . "<br>";

//         // Informations détaillées sur l'erreur SQL
//         $errorInfo = $stmt->errorInfo();
//         echo "Code d'erreur SQL : " . $errorInfo[0] . "<br>";
//         echo "Code d'erreur du pilote : " . $errorInfo[1] . "<br>";
//         echo "Message d'erreur du pilote : " . $errorInfo[2] . "<br>";
//         die;
//     }

//     header('Location: ../vue/planning.php');
//     exit();
// }
?>
