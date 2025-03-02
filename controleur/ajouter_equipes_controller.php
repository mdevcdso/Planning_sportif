<?php
require_once '../modele/config.php';
require_once '../modele/matchs.php';
require_once '../modele/equipes.php';
require_once '../modele/joueurs.php';

session_start();

$id_match = Matchs::getLastInsertedMatchId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupérez les données des équipes et joueurs
    $equipe1 = $_POST['equipe1'];
    $nombre_joueurs1 = $_POST['nombre_joueurs1'];
    $nom_entraineur1 = $_POST['nom_entraineur1'];
    $nombre_victoire1 = $_POST['nombre_victoire1'];
    $nombre_defaite1 = $_POST['nombre_defaite1'];

    $equipe2 = $_POST['equipe2'];
    $nombre_joueurs2 = $_POST['nombre_joueurs2'];
    $nom_entraineur2 = $_POST['nom_entraineur2'];
    $nombre_victoire2 = $_POST['nombre_victoire2'];
    $nombre_defaite2 = $_POST['nombre_defaite2'];

    // Calcul du ratio pour l'équipe 1
    if (($nombre_victoire1 + $nombre_defaite1) > 0) {
        $ratio1 = $nombre_victoire1 / ($nombre_victoire1 + $nombre_defaite1);
    } else {
        $ratio1 = 0; // Éviter une division par zéro
    }

    // Calcul du ratio pour l'équipe 2
    if (($nombre_victoire2 + $nombre_defaite2) > 0) {
        $ratio2 = $nombre_victoire2 / ($nombre_victoire2 + $nombre_defaite2);
    } else {
        $ratio2 = 0; // Éviter une division par zéro
    }

    // Récupérez les données des joueurs de l'équipe 1
    $joueurs_equipe1 = $_POST['joueur_equipe1'];
    $details_joueurs1 = array_map('explode', array_fill(0, count($joueurs_equipe1), ','), $joueurs_equipe1);

    // Récupérez les données des joueurs de l'équipe 2
    $joueurs_equipe2 = $_POST['joueur_equipe2'];
    $details_joueurs2 = array_map('explode', array_fill(0, count($joueurs_equipe2), ','), $joueurs_equipe2);

    // Ajoutez la logique pour insérer le match dans la base de données
    try {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

        // // Insertion des équipes
        $stmtEquipe1 = $bdd->prepare("INSERT INTO equipes (nom_equipe, nombre_joueurs, nom_entraineur, ratio, nombre_victoire, nombre_defaite) VALUES (:equipe1, :nombre_joueurs, :nom_entraineur, :ratio, :nombre_victoire, :nombre_defaite)");
        $stmtEquipe1->bindParam(':equipe1', $equipe1);
        $stmtEquipe1->bindParam(':nombre_joueurs', $nombre_joueurs1);
        $stmtEquipe1->bindParam(':nom_entraineur', $nom_entraineur1);
        $stmtEquipe1->bindParam(':ratio', $ratio1);
        $stmtEquipe1->bindParam(':nombre_victoire', $nombre_victoire1);
        $stmtEquipe1->bindParam(':nombre_defaite', $nombre_defaite1);
        $stmtEquipe1->execute();
        $idEquipe1 = $bdd->lastInsertId();

        $stmtEquipe2 = $bdd->prepare("INSERT INTO equipes (nom_equipe, nombre_joueurs, nom_entraineur, ratio, nombre_victoire, nombre_defaite) VALUES (:equipe2, :nombre_joueurs, :nom_entraineur, :ratio, :nombre_victoire, :nombre_defaite)");
        $stmtEquipe2->bindParam(':equipe2', $equipe2);
        $stmtEquipe2->bindParam(':nombre_joueurs', $nombre_joueurs2);
        $stmtEquipe2->bindParam(':nom_entraineur', $nom_entraineur2);
        $stmtEquipe2->bindParam(':ratio', $ratio2);
        $stmtEquipe2->bindParam(':nombre_victoire', $nombre_victoire2);
        $stmtEquipe2->bindParam(':nombre_defaite', $nombre_defaite2);
        $stmtEquipe2->execute();
        $idEquipe2 = $bdd->lastInsertId();

        // Insertion des joueurs pour l'équipe 1
        for ($i = 0; $i < count($details_joueurs1); $i++) {
            $stmtJoueur = $bdd->prepare("INSERT INTO joueurs (nom_joueurs, prenom_joueur, age_joueur, role, id_equipe) VALUES (:nom_joueur, :prenom_joueur, :age_joueur, :role, :id_equipe)");
            $stmtJoueur->bindParam(':nom_joueur', $details_joueurs1[$i][0]);
            $stmtJoueur->bindParam(':prenom_joueur', $details_joueurs1[$i][1]);
            $stmtJoueur->bindParam(':age_joueur', $details_joueurs1[$i][2]);
            $stmtJoueur->bindParam(':role', $details_joueurs1[$i][3]);
            $stmtJoueur->bindParam(':id_equipe', $idEquipe1);
            $stmtJoueur->execute();
        }

        // Insertion des joueurs pour l'équipe 2
        for ($i = 0; $i < count($details_joueurs2); $i++) {
            $stmtJoueur = $bdd->prepare("INSERT INTO joueurs (nom_joueurs, prenom_joueur, age_joueur, role, id_equipe) VALUES (:nom_joueur, :prenom_joueur, :age_joueur, :role, :id_equipe)");
            $stmtJoueur->bindParam(':nom_joueur', $details_joueurs2[$i][0]);
            $stmtJoueur->bindParam(':prenom_joueur', $details_joueurs2[$i][1]);
            $stmtJoueur->bindParam(':age_joueur', $details_joueurs2[$i][2]);
            $stmtJoueur->bindParam(':role', $details_joueurs2[$i][3]);
            $stmtJoueur->bindParam(':id_equipe', $idEquipe2);
            $stmtJoueur->execute();
        }

        // Insertion des équipes dans la table Participer
        $stmtParticiper1 = $bdd->prepare("INSERT INTO participer (Id_Matchs, id_equipe) VALUES (:id_match, :id_equipe)");
        $stmtParticiper1->bindParam(':id_match', $id_match);
        $stmtParticiper1->bindParam(':id_equipe', $idEquipe1);
        $stmtParticiper1->execute();

        $stmtParticiper2 = $bdd->prepare("INSERT INTO participer (Id_Matchs, id_equipe) VALUES (:id_match, :id_equipe)");
        $stmtParticiper2->bindParam(':id_match', $id_match);
        $stmtParticiper2->bindParam(':id_equipe', $idEquipe2);
        $stmtParticiper2->execute();

    } catch (PDOException $e) {
        // Gérez les erreurs liées à la base de données ici
        echo "Erreur : " . $e->getMessage() . "<br>";
        die;
    }

    header('Location: ../vue/planning.php?id_match=' . $id_match);
    exit();
}

?>
