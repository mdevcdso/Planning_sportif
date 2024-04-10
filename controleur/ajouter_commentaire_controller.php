<?php
require_once '../modele/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_match']) && !empty($_POST['commentaire'])) {
    $idMatch = $_POST['id_match'];
    $commentaireTexte = strip_tags($_POST['commentaire']); // Nettoyage basique pour éviter l'injection de script

    $cheminFichier = "../commentaires/commentaires.json"; // Chemin vers le fichier JSON global

    // Vérifiez si le fichier global existe déjà
    if (file_exists($cheminFichier)) {
        $tousLesCommentaires = json_decode(file_get_contents($cheminFichier), true);
    } else {
        $tousLesCommentaires = [];
    }

    // Créer une clé unique pour le commentaire
    $commentaireID = uniqid('com');

    // Préparer le commentaire avec sa clé unique, date, et contenu
    $commentaire = [
        $commentaireID => [
            "date" => date('Y-m-d H:i:s'),
            "content" => $commentaireTexte
        ]
    ];

    // Ajouter le nouveau commentaire sous le bon ID de match
    if (!isset($tousLesCommentaires[$idMatch])) {
        $tousLesCommentaires[$idMatch] = [];
    }
    
    $tousLesCommentaires[$idMatch] += $commentaire;

    // Enregistrez le tableau de commentaires mis à jour dans le fichier global
    file_put_contents($cheminFichier, json_encode($tousLesCommentaires));

    if(file_put_contents($cheminFichier, json_encode($tousLesCommentaires))) {
        // Redirection pour éviter la soumission multiple du formulaire
        header("Location: ../vue/planning.php");
        exit();
    } else {
        echo "Les données n'ont pas été insérées dasn le fichier json";
    }
}
?>
