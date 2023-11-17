
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-Fxg9fPDJ+yzB3FVsHQ/42P5n9k5W0J0vq5Mp9P9c+X3bm4Y7pCbW+dTtTayy/8f8uERn0pspf2cj4IxLp2/ZtQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="bouton-menu">
            <button onclick="toggleMenu()">Menu</button>
        </div>
        <div class="menu-latéral">
            <?php include('menu.php'); ?>
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
                var menu = document.querySelector('.menu-latéral');
                var contenu = document.querySelector('.planning');
                var bouton = document.querySelector('.bouton-menu button');

                menu.classList.toggle('visible');
                contenu.classList.toggle('contenu-decalé');
                bouton.classList.toggle('bouton-decalé');
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