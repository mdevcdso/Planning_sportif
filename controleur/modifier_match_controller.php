<?php
// modifier_match_controller.php
require_once '../modele/config.php';
require_once '../modele/matchs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $id_match = $_POST['match_id'];
    $nouveau_titre = $_POST['nouveau_titre'];
    $nouvelle_date = $_POST['nouvelle_date'];
    $nouveau_lieu = $_POST['nouveau_lieu'];
    $nouvelle_description = $_POST['nouvelle_description'];
    $nouveau_score = $_POST['nouveau_score'];

    // Récupérez les données actuelles du match
    $match_actuel = Matchs::getMatchById($id_match);

    // Vérifiez et effectuez les modifications nécessaires
    if (!empty($nouveau_titre)) {
        $match_actuel['titre'] = $nouveau_titre;
    }

    if (!empty($nouvelle_date)) {
        $match_actuel['date_match'] = $nouvelle_date;
    }

    if (!empty($nouveau_lieu)) {
        $match_actuel['lieu_match'] = $nouveau_lieu;
    }

    if (!empty($nouvelle_description)) {
        $match_actuel['description_match'] = $nouvelle_description;
    }

    if (!empty($nouveau_score)) {
        $match_actuel['score'] = $nouveau_score;
    }

    try{
        $success = Matchs::modifierMatch($id_match, $match_actuel);

        if ($success) {
            echo "Modification réussie !";
        } else {
            echo "Aucune modification effectuée ou une erreur s'est produite.";
        }
    } catch (PDOException $e) {
        // Gérez les erreurs liées à la base de données ici
        echo "Erreur : " . $e->getMessage() . "<br>";
        die;
    }

    // Redirigez vers la page du planning après la modification du match
    header('Location: ../vue/planning.php');
    exit();
}
?>
