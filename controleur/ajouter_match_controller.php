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
            $id_sport = $_POST['Id_Sport'];
            $description_match = $_POST['description_match'];

            $etat_match = 'en_attente';

            try {

                // Insertion des informations du match
                $query = "INSERT INTO matchs (titre, duree, date_match, lieu_match, description_match, id_utilisateur) VALUES (:titre, :duree, :date_match, :lieu_match, :description_match, :id_utilisateur)";
                $stmt = $bdd->prepare($query);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':duree', $duree);
                $stmt->bindParam(':date_match', $date_match);
                $stmt->bindParam(':lieu_match', $lieu_match);
                $stmt->bindParam(':description_match', $description_match);
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->execute();
                $lastInsertedMatchId = $bdd->lastInsertId();

                // Recherche de l'ID planning correspondant à l'ID utilisateur
                $queryPlanning = "SELECT id_planning FROM Planning WHERE id_utilisateur = :id_utilisateur";
                $stmtPlanning = $bdd->prepare($queryPlanning);
                $stmtPlanning->bindParam(':id_utilisateur', $id_utilisateur);
                $stmtPlanning->execute();
                $resultPlanning = $stmtPlanning->fetch(PDO::FETCH_ASSOC);

                if ($resultPlanning) {
                    $id_planning = $resultPlanning['id_planning'];

                    // Insertion dans la table Afficher
                    $queryAfficher = "INSERT INTO Afficher (id_planning, Id_Matchs, date_match) VALUES (:id_planning, :Id_Matchs, :date_match)";
                    $stmtAfficher = $bdd->prepare($queryAfficher);
                    $stmtAfficher->bindParam(':id_planning', $id_planning);
                    $stmtAfficher->bindParam(':Id_Matchs', $lastInsertedMatchId);
                    $stmtAfficher->bindParam(':date_match', $date_match);
                    $stmtAfficher->execute();

                    // Insertion dans la table Concerner pour lier le match au sport
                    $queryConcerner = "INSERT INTO Concerner (Id_Matchs, Id_Sport) VALUES (:Id_Matchs, :Id_Sport)";
                    $stmtConcerner = $bdd->prepare($queryConcerner);
                    $stmtConcerner->bindParam(':Id_Matchs', $lastInsertedMatchId);
                    $stmtConcerner->bindParam(':Id_Sport', $id_sport);
                    $stmtConcerner->execute();
                } else {
                    echo "L'ID du planning n'a pas pu être récupéré.";
                }

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

            header('Location: ../vue/planning.php?id_match=' . $lastInsertedMatchId);
            exit();
        } else {
            echo "L'ID de l'utilisateur n'a pas pu être récupéré.";
        }
    } else {
        echo "La session n'est pas démarrée.";
    }
}
?>
