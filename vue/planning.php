<?php
session_start();

if (!isset($_SESSION['email_utilisateur'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: ../vue/connexion.php');
    exit();
}

require_once '../modele/matchs.php';
require_once '../modele/equipes.php';
require_once '../modele/joueurs.php';

$matchs = Matchs::getMatchs();
$equipes = Equipes::getEquipes();
$joueurs = Joueurs::getJoueurs();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Planning</title>
        <link rel="stylesheet" href="../vue/styles.css">
    </head>
    <body>
        <div class="bouton-menu">
            <button onclick="toggleMenu()">Menu</button>
        </div>
        <div class="menu-latéral">
            <h2 style="color: white;">Menu</h2>
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

        <div class="planning-content" id="planningContent">
            <?php
                include '../vue/semaine.php';
            ?>
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