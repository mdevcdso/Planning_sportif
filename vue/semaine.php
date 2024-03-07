<?php
require_once '../modele/matchs.php';
require_once '../modele/equipes.php';
require_once '../modele/joueurs.php';

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
                                        <a href="../vue/ajouter_equipes_joueurs.php?id_match=<?= $match['Id_Matchs']; ?>"><button>Ajouter des équipes</button></a>
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
</script>