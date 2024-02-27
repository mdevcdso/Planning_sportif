<?php
require_once '../modele/config.php';
require_once '../modele/matchs.php';
require_once '../modele/equipes.php';
require_once '../modele/joueurs.php';
require_once '../modele/participer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matchId = $_POST['match_id'];

    // Récupérer les informations du match
    $match = Matchs::getMatchById($matchId);

    if ($match) {
        // Supprimer les équipes associées au match
        $equipesMatch = Equipes::getEquipesForMatch($matchId);
        
        foreach ($equipesMatch as $equipe) {
            $idEquipe = Equipes::getEquipeIdByName($equipe['nom_equipe']);
    
            if ($idEquipe) {
                // Supprimer les joueurs de l'équipe
                $joueursEquipe = Joueurs::getJoueursByEquipe($idEquipe);
                
                foreach ($joueursEquipe as $joueur) {
                    // Supprimer le joueur
                    Joueurs::supprimerJoueur($joueur['id_joueur']);
                }
        
                // Supprimer l'équipe
                Equipes::supprimerEquipe($idEquipe);
                
                // Supprimer les participations pour ce match
                Participer::supprimerParticipationsPourMatch($matchId);
            }
        }
        // Supprimer le match
         $success = Matchs::supprimerMatch($matchId);

        if ($success) {
            echo "Le match '{$match['titre']}' a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du match.";
        }
    } else {
        echo "Match non trouvé.";
    }

    // Redirigez vers la page du planning après la suppression du match
    header('Location: ../vue/planning.php');
    exit();
}
?>
