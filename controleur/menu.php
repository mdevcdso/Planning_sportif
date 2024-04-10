<?php
// Déterminer les éléments de menu basés sur le rôle de l'utilisateur
$menuItems = [
    'Se déconnecter' => '../controleur/deconnexion_controller.php'
];

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Organisateur') {
    // Ajouter des éléments de menu spécifiques aux organisateurs
    $menuItems = array_merge(array(
        array(
            'name' => 'Navigation',
            'subItems' => array(
                'Planning' => '../vue/planning.php',
                'Ajouter un match' => '../vue/ajouter_match.php',
                'Modifier un match' => '../vue/modifier_match.php',
                'Supprimer un match' => '../vue/supprimer_match.php'
            )
        ),
        array(
            'name' => 'Paramètres du compte',
            'subItems' => array(
                'Modifier le mot de passe' => '../vue/parametres.php'
            )
        )
    ), $menuItems);
} elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Visionneur') {
    // Ajouter ou modifier des éléments de menu pour les visionneurs
    $menuItems = array_merge(array(
        array(
            'name' => 'Navigation',
            'subItems' => array(
                'Planning' => '../vue/planning.php'
            )
        ),
        array(
            'name' => 'Paramètres du compte',
            'subItems' => array(
                'Modifier le mot de passe' => '../vue/parametres.php'
            )
        )
    ), $menuItems);
}