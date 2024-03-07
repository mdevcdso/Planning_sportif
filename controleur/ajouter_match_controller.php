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
