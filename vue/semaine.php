<?php
require_once '../modele/matchs.php';
require_once '../modele/equipes.php';
require_once '../modele/joueurs.php';

// Vérifier si des résultats de recherche ont été stockés dans la session
if (isset($_SESSION['resultats_recherche'])) {
    $matchs = $_SESSION['resultats_recherche']; // Utilisez les résultats de la recherche
    unset($_SESSION['resultats_recherche']); // Effacez les résultats de recherche pour éviter des affichages répétitifs lors des futures visites
} else {
    $matchs = Matchs::getMatchs(); // Sinon, récupérez tous les matchs comme avant
}

$matchs = Matchs::getMatchs();
$equipes = Equipes::getEquipes();
$joueurs = Joueurs::getJoueurs();

// Récupérer le lundi de la semaine actuelle ou celui de la semaine passée
$currentWeekMonday = isset($_GET['week']) ? $_GET['week'] : date('Y-m-d', strtotime('Monday this week'));

// Calculer le lundi de la semaine précédente et suivante
$weekStart = strtotime('Monday', strtotime($currentWeekMonday));
$prevWeekMonday = date('Y-m-d', strtotime('-1 week', $weekStart));
$nextWeekMonday = date('Y-m-d', strtotime('+1 week', $weekStart));

// Générer les dates de la semaine
$datesOfWeek = [];
for ($i = 0; $i < 7; $i++) {
    $datesOfWeek[] = date('Y-m-d', strtotime("+$i days", $weekStart));
}
?>
<div class="tete_planning">
    <a href="?week=<?= $prevWeekMonday; ?>" class="arrow">❮</a>
    <h1>
        Planning
    </h1>
    <a href="?week=<?= $nextWeekMonday; ?>" class="arrow">❯</a>

    <!-- Formulaire barre de recherche étendu -->
    <form action="../controleur/rechercher_controller.php" method="POST">
        <input type="text" name="rechercher" placeholder="Entrer le nom d'un match">

        <div id="critere_date" style="display: none;">
            <input type="date" name="date_match" placeholder="Date du match">
        </div>

        <div id="critere_equipe" style="display: none;">
            <input type="text" name="equipe_match" placeholder="Une équipe du match">
        </div>

        <button type="button" id="plus" onclick="ajouterCriteres()">+</button>
        
        <input type="submit" value="Rechercher" style="width: auto;">
    </form>
</div>

<div class="planning">
    <div class="tableau">
        <div class="mois">
            <h2><?= date('F Y', strtotime($currentWeekMonday)); ?></h2>
        </div>
        
        <div class="jours">
            <?php foreach ($datesOfWeek as $date): ?>
                <h3><?= date('D d', strtotime($date)); ?></h3>
            <?php endforeach; ?>
        </div>
        <div class="tableau">
            <div class="grille-planning">
            <?php $matchsGroupedByDate = Matchs::groupMatchsByDate($matchs);
                foreach ($datesOfWeek as $date): ?>
                    <div class="jour">
                        <ul class="cases-tableau">
                            <?php foreach ($matchsGroupedByDate[$date] ?? [] as $match): ?>
                                <li>
                                    <h4><?= $match['titre']; ?></h4>
                                        <p><?= date('H:i', strtotime($match['date_match']))?> <?=  $match['duree']; ?> h</p>
                                        <p><?= date('d/m/Y', strtotime($match['date_match'])); ?></p>
                                        <p><?= $match['lieu_match']; ?></p>

                                    <!-- Afficher le nom des équipes et le bouton pour saisir les équipes et joueurs -->
                                    <?php $equipesMatch = Equipes::getEquipesForMatch($match['Id_Matchs']); ?>

                                    <?php if (!empty($equipesMatch)): ?>
                                        <?php foreach ($equipesMatch as $equipe): ?>
                                            <p><?= $equipe['nom_equipe']; ?></p>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php if ($_SESSION['user_role'] == 'Organisateur'): ?>
                                            <a href="../vue/ajouter_equipes_joueurs.php?id_match=<?= $match['Id_Matchs']; ?>">
                                                <button>Ajouter des équipes</button>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($match['score']) || $match['score'] != '0'): ?>
                                        <!-- Si le score est défini, afficher le score -->
                                        <p>Score : <?= $match['score']; ?></p>
                                    <?php else: ?>
                                        <!-- Sinon, afficher le bouton pour saisir les scores -->
                                        <button class="show-score-form" data-match-id="<?= $match['Id_Matchs']; ?>">Saisir les scores</button>
                                    <?php endif; ?>
                                    <!-- Formulaire de saisie des scores -->
                                    <form action="../controleur/saisir_scores_controller.php" class="score-form" style="display: none;" method="POST">
                                        <label for="score">Score :</label>
                                        <input type="text" name="score" placeholder="Format : 15 - 5" required>
                                        <input type="hidden" name="match_id" value="<?= $match['Id_Matchs'] ?>">
                                        <input type="submit" value="Enregistrer">
                                    </form>

                                    <button onclick="afficherFormulaireCommentaire('<?= $match['Id_Matchs']; ?>')">Ajouter un commentaire</button>

                                    <div id="formulaire-commentaire-<?= $match['Id_Matchs']; ?>" style="display:none;">
                                        <form action="../controleur/ajouter_commentaire_controller.php" method="POST">
                                            <input type="hidden" name="id_match" value="<?= $match['Id_Matchs']; ?>">
                                            <input type="text" name="commentaire" placeholder="Ajouter un commentaire...">
                                            <button type="submit">Envoyer</button>
                                        </form>
                                    </div>

                                    <?php
                                    $cheminFichier = "../commentaires/commentaires.json";
                                    if (file_exists($cheminFichier)) {
                                        $tousLesCommentaires = json_decode(file_get_contents($cheminFichier), true);
                                        // Vérifier si des commentaires existent pour ce match
                                        if (isset($tousLesCommentaires[$match['Id_Matchs']])) {
                                            // Parcourir chaque commentaire pour l'ID du match courant
                                            foreach ($tousLesCommentaires[$match['Id_Matchs']] as $idCommentaire => $commentaire) {
                                                // Assurez-vous d'encoder avec htmlspecialchars pour éviter les injections XSS
                                                echo "<p><strong>" . htmlspecialchars($commentaire['date']) . "</strong>: " . htmlspecialchars($commentaire['content']) . "</p>";
                                            }
                                        }
                                    }
                                    ?>

                                    <!-- Vérifiez si la clé 'match_termine' et l'ID du match existent dans la session avant d'afficher le message
                                    if (isset($_SESSION['match_termine']) && isset($_SESSION['match_termine'][$match['Id_Matchs']]) && $_SESSION['match_termine'][$match['Id_Matchs']] == true) {
                                        echo "<p>Ce match est terminé.</p>";
                                    } -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionnez tous les boutons "Saisir les scores"
        var scoreButtons = document.querySelectorAll('.show-score-form');

        // Pour chaque bouton, ajoutez un gestionnaire d'événements onclick
        scoreButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Trouvez le formulaire de saisie des scores correspondant
                var scoreForm = this.parentNode.querySelector('.score-form');

                // Affichez le formulaire
                scoreForm.style.display = 'block';
            });
        });
    });

    function ajouterCriteres() {
        var critereDate = document.getElementById("critere_date");
        var critereEquipe = document.getElementById("critere_equipe");
        var bouton = document.getElementById("bouton_modif");

        // Affiche le critère de la date en premier
        if (critereDate.style.display === "none") {
            critereDate.style.display = "block";
        // Puis, affiche le critère de l'équipe
        } else if (critereEquipe.style.display === "none") {
            critereEquipe.style.display = "block";
            // Change le bouton "+" en "x" une fois que tous les critères sont affichés
            bouton.innerHTML = "x";
        // Cache les critères et remet le bouton à "+"
        } else {
            critereDate.style.display = "none";
            critereEquipe.style.display = "none";
            bouton.innerHTML = "+";
        }
    }

    function afficherFormulaireCommentaire(idMatch) {
        var formulaire = document.getElementById('formulaire-commentaire-' + idMatch);
        formulaire.style.display = 'block';
    }
</script>