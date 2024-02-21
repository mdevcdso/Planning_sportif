<?php
$menuItems = array(
    array(
        'name' => 'Gestion des matchs',
        'subItems' => array(
            'Planning' => '../vue/planning.php',
            'Ajouter un match' => '../vue/ajouter_match.php',
            'Modifier un match' => '../vue/modifier_match.php',
            'Supprimer un match' => '../vue/supprimer_match.php',
            'Se déconnecter' => '../controleur/deconnexion_controller.php'
        )
    ),
    array(
        'name' => 'Matchs favoris',
        'subItems' => array()
    ),
    array(
        'name' => 'Notifications',
        'subItems' => array()
    ),
    array(
        'name' => 'Design Planning',
        'subItems' => array()
    ),
    array(
        'name' => 'Paramètres du compte',
        'subItems' => array()
    )
);