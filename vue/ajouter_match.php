<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un match</title>
    <link rel="stylesheet" href="../vue/styles.css">
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

    <h1>Ajouter un match</h1>
    <div class="disposition_form">
        <form action="../controleur/ajouter_match_controller.php" class = "fonct_form" method="POST">
            <label for="titre">Titre :</label>
            <input type="text" name="titre" required><br>

            <label for="duree">Durée :</label>
            <input type="time" name="duree" required><br>

            <label for="date_match">Date et heure du match :</label>
            <input type="datetime-local" name="date_match" required><br>

            <label for="lieu_match">Lieu :</label>
            <input type="text" name="lieu_match" required><br>

            <label for="Sport" style="display: block; margin-top: 1rem;">
                Sport concerné : 
                <select name="Id_Sport" id="Sport">
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

            <label for="description_match">Description :</label>
            <textarea name="description_match" rows="4" cols="50"></textarea><br>

            <input type="submit" value="Ajouter">
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
