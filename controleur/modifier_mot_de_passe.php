<?php
session_start();

require_once '../modele/config.php';

if (!isset($_SESSION['email_utilisateur'])) {
    // Rediriger si l'utilisateur n'est pas connecté
    header('Location: ../vue/connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire de modification de mot de passe
    $nouveauMotDePasse = $_POST['nouveau_mot_de_passe'];
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];

    // Valider les mots de passe
    if ($nouveauMotDePasse !== $confirmerMotDePasse) {
        // Les mots de passe ne correspondent pas, rediriger avec un message d'erreur
        header('Location: ../vue/parametres.php?error=1');
        exit();
    }

    // Hacher le nouveau mot de passe
    $nouveauMotDePasseHash = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

    // Mettre à jour le mot de passe dans la base de données
    $emailUtilisateur = $_SESSION['email_utilisateur'];
    $requeteUpdateMdp = $connexion->prepare("UPDATE utilisateurs SET mot_de_passe = :nouveauMotDePasse WHERE email_utilisateur = :emailUtilisateur");
    $requeteUpdateMdp->execute([
        ":nouveauMotDePasse" => $nouveauMotDePasseHash,
        ":emailUtilisateur" => $emailUtilisateur
    ]);

    // Vérifier si la mise à jour s'est effectuée avec succès
    if ($requeteUpdateMdp) {
        // Rediriger vers la page des paramètres avec un message de succès
        header('Location: ../vue/connexion.php?success=1');
        exit();
    } else {
        // Rediriger vers la page des paramètres avec un message d'erreur
        header('Location: ../vue/connexion.php?error=2');
        exit();
    }
}
?>
