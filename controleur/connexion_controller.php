<?php
// login_controller.php
require_once '../modele/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Vérifier les informations de connexion dans la base de données
    require_once '../modele/utilisateur.php';

    $userData = Utilisateur::verifierConnexion($email, $mdp);
    if ($userData) {
        // Connexion réussie, démarrer la session et stocker l'identifiant de l'utilisateur
        session_start();
        $_SESSION['email_utilisateur'] = $email;
        $_SESSION['user_role'] = $userData['role'];
        
        header('Location: ../vue/planning.php');
        exit();
    } else {
        // Afficher un message d'erreur ou rediriger vers la page de connexion avec un message d'erreur
        echo "Email ou mot de passe incorrects";
    }
}
?>
