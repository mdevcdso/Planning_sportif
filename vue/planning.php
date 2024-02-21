<?php
session_start();

if (!isset($_SESSION['email_utilisateur'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: ../vue/connexion.php');
    exit();
}
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
            <h2 style="color: white;">Bonjour !</h2>
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
        <h1>
            Planning
        </h1>
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
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                        <div class="jour">
                            <ul class="cases-tableau">
                                <li>
                                    <h4>Match 1</h4>
                                    <p>17:00 - 18:30</p>
                                    <p>Football</p>
                                </li>
                                <div class="divider"></div>
                                <li>
                                    <h4>Match 2</h4>
                                    <p>19:00 - 20:30</p>
                                    <p>Basketball</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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