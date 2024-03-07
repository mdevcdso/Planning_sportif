<?php
require_once '../modele/config.php';
require_once '../modele/matchs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $score = $_POST['score'];
    $matchId = $_POST['match_id'];

    try {
        Matchs::saisirScores($matchId, $score);

        // Vérifiez si la mise à jour a réussi
        if (Matchs::saisirScores($matchId, $score)) {
            // Redirigez l'utilisateur vers la page du planning
            header('Location: ../vue/planning.php');
            exit();
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
    
} else {
    echo "Les scores n'ont pas pu être récupérés.";
}
?>
