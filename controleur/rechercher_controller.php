<?php
require_once '../modele/config.php';
require_once '../modele/matchs.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['rechercher'];
    $dateMatch = !empty($_POST['date_match']) ? $_POST['date_match'] : null;
    $equipeMatch = !empty($_POST['nom_equipe']) ? $_POST['nom_equipe'] : null;

    try {
        $matchs = Matchs::getMatchByCriteria($titre, $dateMatch, $equipeMatch);
        
        if (!empty($matchs)) {
            $firstMatchDate = $matchs[0]['date_match']; // Prendre la date du premier match trouvé
            
            // Calcul pour trouver le lundi de cette semaine et rediriger
            $date = new DateTime($firstMatchDate);
            $weekMonday = $date->modify('Monday this week')->format('Y-m-d');
            
            header('Location: ../vue/planning.php?week=' . $weekMonday);
            exit();
        } else {
            header('Location: ../vue/planning.php?no_match_found=true');
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br>";
        die;
    }
}

?>