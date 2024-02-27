<?php
require_once '../modele/matchs.php';
require_once '../modele/equipes.php';
require_once '../modele/joueurs.php';

$matchs = Matchs::getMatchs();
$equipes = Equipes::getEquipes();
$joueurs = Joueurs::getJoueurs();
?>
<div class="tete_planning">
    <button onclick="togglePlanningView()">Changer de vue</button>
    <h1>
        Planning
    </h1>
</div>
<div class="planning">
    <div class="tableau">
        <div class="jours">
            <h3>
                Lundi
            </h3>
            <h3>
                Mardi
            </h3>
            <h3>
                Mercredi
            </h3>
            <h3>
                Jeudi
            </h3>
            <h3>
                Vendredi
            </h3>
            <h3>
                Samedi
            </h3>
            <h3>
                Dimanche
            </h3>
        </div>
        <div class="tableau">
            <div class="grille-planning">
                <?php $matchsGroupedByDate = Matchs::groupMatchsByDate($matchs);
                foreach ($matchsGroupedByDate as $matchsByDate): ?>
                    <div class="jour">
                        <ul class="cases-tableau">
                            <?php foreach ($matchsByDate as $match): ?>
                                <li>
                                    <h4><?= $match['titre']; ?></h4>
                                    <p><?= date('H:i', strtotime($match['date_match'])); ?> - <?= date('H:i', strtotime($match['date_match'] . ' + ' . $match['duree'])); ?></p>
                                    <p><?= date('d/m/Y', strtotime($match['date_match'])); ?></p>
                                    <p><?= $match['lieu_match']; ?></p>
                                    <!-- Afficher le nom des équipes -->
                                    <?php $equipesMatch = Equipes::getEquipesForMatch($match['Id_Matchs']); ?>
                                    <?php foreach ($equipesMatch as $equipe): ?>
                                        <p><?= $equipe['nom_equipe']; ?></p>
                                    <?php endforeach; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>