<!-- modifier_match.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un match</title>
    <link rel="stylesheet" href="../vue/styles.css">
    <style>
        label {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="bouton-menu">
        <button onclick="toggleMenu()">Menu</button>
    </div>
    <div class="menu-latéral">
        <h2>Menu</h2>
        <button class="fermer-menu" onclick="fermerMenu()"><img src="../img/close.svg" alt="close"></button>
        <?php require('../controleur/menu.php'); ?>
        <ul class="menu">
            <?php foreach ($menuItems as $key => $menuItem): ?>
                <?php if (is_array($menuItem)): ?>
                    <li class="menu-item" data-menu="<?= $menuItem['name']; ?>">
                        <?= $menuItem['name']; ?>
                        <?php if (!empty($menuItem['subItems'])): ?>
                            <ul class="sub-items" data-submenu="<?= $menuItem['name']; ?>">
                                <?php foreach ($menuItem['subItems'] as $subItemName => $subItemLink): ?>
                                    <li class="sub-item"><a href="<?= $subItemLink; ?>"><?= $subItemName; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php else:?>
                    <li class="menu-item"><a href="<?= $menuItem; ?>"><?= $key; ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <h1>Modifier un match</h1>

    <div class="disposition_form">
        <form action="../controleur/modifier_match_controller.php" class="fonct_form" method="POST">
            <label for="match_id">Sélectionnez le match à modifier :</label>
            <select name="match_id" id="match_id">
                <!-- Afficher la liste des matchs existants -->
                <?php
                require_once '../modele/matchs.php';
                $matchs = Matchs::getMatchs();
                foreach ($matchs as $match) {
                    echo "<option value='{$match['Id_Matchs']}'>{$match['titre']}</option>";
                }            
                ?>
            </select>

            <!-- Ajoutez ici les champs nécessaires pour modifier un match -->
            <!-- Par exemple : -->
            <label for="nouveau_titre">Nouveau titre :</label>
            <input type="text" name="nouveau_titre">

            <label for="nouvelle_duree">Nouvelle durée :</label>
            <input type="time" name="nouvelle_duree">

            <label for="nouvelle_date">Nouvelle date :</label>
            <input type="datetime-local" name="nouvelle_date">

            <label for="nouveau_lieu">Nouveau lieu :</label>
            <input type="text" name="nouveau_lieu">

            <label for="nouveau_sport" style="display: block; margin-top: 1rem;">
                Nouveau sport : 
                <select name="nouveau_sport" id="Sport">
                    <?php
                        // Inclure la configuration de la base de données ici
                        require_once '../modele/config.php';
                        require_once '../modele/sport.php';

                        // Sélectionner tous les sports depuis la table Sport
                        $result = Sport::getNomsSports();

                        // Boucler à travers les résultats et créer une option pour chaque sport
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['Id_Sport'] . '">' . $row['nom_sport'] . '</option>';
                        }

                        // Fermer la connexion à la base de données
                        $connexion = null;
                    ?>
                </select>
            </label>

            <label for="nouvelle_description">Nouvelle description :</label>
            <input type="text" name="nouvelle_description">

            <label for="nouveau_score">Nouveau score :</label>
            <input type="text" name="nouveau_score">

            <!-- Dans modifier_match.php, ajoutez cette case à cocher au formulaire -->
            <!-- <label for="match_termine">Match terminé :</label>
            <input type="checkbox" name="match_termine" id="match_termine" value="1"> -->

            <input type="submit" value="Modifier" style = "width: 4rem; height: 2rem; margin-top: 1rem;">
        </form>
    </div>

    <script>
        function toggleMenu() {
            var titre = document.querySelector('h1');
            var menu = document.querySelector('.menu-latéral');
            var contenu = document.querySelector('.planning');
            var bouton = document.querySelector('.bouton-menu button');
            
            titre.classList.toggle('titre-decalé');
            menu.classList.toggle('visible');
            contenu.classList.toggle('contenu-decalé');
            bouton.classList.toggle('bouton-decalé');
        }

        function fermerMenu() {
            var titre = document.querySelector('h1');
            var menu = document.querySelector('.menu-latéral');
            var contenu = document.querySelector('.planning');
            var bouton = document.querySelector('.bouton-menu button');

            titre.classList.remove('titre-decalé');
            menu.classList.remove('visible');
            contenu.classList.remove('contenu-decalé');
            bouton.classList.remove('bouton-decalé');
        }

        const menuItems = document.querySelectorAll('[data-menu]');
        menuItems.forEach(menuItem => {
            menuItem.addEventListener('mouseover', () => {
                const submenuName = menuItem.getAttribute('data-menu');
                const submenu = document.querySelector(`[data-submenu="${submenuName}"]`);
                if (submenu) {
                    submenu.style.display = 'block';
                }
            });

            menuItem.addEventListener('mouseout', () => {
                const submenuName = menuItem.getAttribute('data-menu');
                const submenu = document.querySelector(`[data-submenu="${submenuName}"]`);
                if (submenu) {
                    submenu.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
