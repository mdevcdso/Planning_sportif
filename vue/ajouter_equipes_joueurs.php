<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Equipes et Joueurs</title>

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
            <?php foreach ($menuItems as $menuItem): ?>
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
            <?php endforeach; ?>
        </ul>
    </div>


    <h1>Ajouter une équipe</h1>

    <div class="disposition_form">
        <form action="../controleur/ajouter_equipes_controller.php" class="fonct_form" method="POST">
            <label for="equipe1">Équipe 1 :</label>
            <input type="text" name="equipe1" required><br>

            <label for="nombre_joueurs1">Nombre de joueurs dans l'équipe 1 :</label>
            <input type="number" name="nombre_joueurs1" required><br>

            <label for="nom_entraineur1">Nom de l'entraineur de l'équipe 1 :</label>
            <input type="text" name="nom_entraineur1" required><br>

            <label for="nombre_victoire1">Nombre de victoires de l'équipe 1 :</label>
            <input type="number" name="nombre_victoire1" required><br>

            <label for="nombre_defaite1">Nombre de défaites de l'équipe 1 :</label>
            <input type="number" name="nombre_defaite1" required><br>


            <!-- Joueurs de l'équipe 1 -->
            <label for="joueurs_equipe1">Joueurs de l'équipe 1 :</label>
            <div id="joueurs_equipe1_container">
                <!-- Champ pour le premier joueur -->
                <input type="text" name="joueur_equipe1[]" placeholder="Nom, Prénom, Âge, Rôle" required><br>
            </div>
            <button type="button" onclick="ajouterJoueur('joueurs_equipe1_container')">Ajouter un joueur</button><br>


            <label for="equipe2">Équipe 2 :</label>
            <input type="text" name="equipe2" required><br>

            <label for="nombre_joueurs2">Nombre de joueurs dans l'équipe 2 :</label>
            <input type="number" name="nombre_joueurs2" required><br>

            <label for="nom_entraineur2">Nom de l'entraineur de l'équipe 2 :</label>
            <input type="text" name="nom_entraineur2" required><br>

            <label for="nombre_victoire2">Nombre de victoires de l'équipe 2 :</label>
            <input type="number" name="nombre_victoire2" required><br>

            <label for="nombre_defaite2">Nombre de défaites de l'équipe 2 :</label>
            <input type="number" name="nombre_defaite2" required><br>


            <!-- Joueurs de l'équipe 2 -->
            <label for="joueurs_equipe2">Joueurs de l'équipe 2 :</label>
            <div id="joueurs_equipe2_container">
                <!-- Champ pour le premier joueur -->
                <input type="text" name="joueur_equipe2[]" placeholder="Nom, Prénom, Âge, Rôle" required><br>
            </div>
            <button type="button" onclick="ajouterJoueur('joueurs_equipe2_container')">Ajouter un joueur</button><br>

            <input type="submit" value="Ajouter">
        </form>
    </div>

    <script>
        function ajouterJoueur(containerId) {
            var container = document.getElementById(containerId);
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'joueur_' + containerId.replace('joueurs_', '') + '[]';
            newInput.placeholder = 'Nom, Prénom, Âge, Rôle';
            newInput.required = true;
            container.appendChild(newInput);
            container.appendChild(document.createElement('br'));
        }

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