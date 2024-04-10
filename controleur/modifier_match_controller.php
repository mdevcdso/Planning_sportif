<?php
// modifier_match_controller.php
require_once '../modele/config.php';
require_once '../modele/matchs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $id_match = $_POST['match_id'];
    $nouveau_titre = $_POST['nouveau_titre'];
    $nouvelle_date = $_POST['nouvelle_date'];
    $nouvelle_duree = $_POST['nouvelle_duree'];
    $nouveau_lieu = $_POST['nouveau_lieu'];
    $nouveau_sport = $_POST['nouveau_sport'];
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

    if (!empty($nouvelle_duree)) {
        $match_actuel['duree'] = $nouvelle_duree;
    }

    if (!empty($nouveau_lieu)) {
        $match_actuel['lieu_match'] = $nouveau_lieu;
    }

    if (!empty($nouveau_sport)) {
        $match_actuel['Id_Sport'] = $nouveau_sport;
    }

    if (!empty($nouvelle_description)) {
        $match_actuel['description_match'] = $nouvelle_description;
    }

    if (!empty($nouveau_score)) {
        $match_actuel['score'] = $nouveau_score;
    }

    try{
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $success = Matchs::modifierMatch($id_match, $match_actuel);

        // if (isset($_POST['match_termine']) && $_POST['match_termine'] == '1') {
        //     // Stocker l'état terminé dans la session pour ce match
        //     $_SESSION['match_termine'][$id_match] = true;
        // }

        // Mettre à jour l'association sportive dans la table Concerner
        if ($success) {
            $exist = $bdd->prepare("SELECT * FROM concerner WHERE Id_Matchs = :id_match");
            $exist->execute([':id_match' => $id_match]);
            if ($exist->fetch()) {
                $updateSport = $bdd->prepare("UPDATE concerner SET Id_Sport = :id_sport WHERE Id_Matchs = :id_match");
            } else {
                $updateSport = $bdd->prepare("INSERT INTO concerner (Id_Matchs, Id_Sport) VALUES (:id_match, :id_sport)");
            }
            $updateSport->execute([':id_match' => $id_match, ':id_sport' => $nouveau_sport]);
            echo "Modification réussie !";
        } else {
            echo "Aucune modification effectuée ou une erreur s'est produite.";
        }
    } catch (PDOException $e) {
        // Gérez les erreurs liées à la base de données ici
        echo "Erreur : " . $e->getMessage() . "<br>";
        die;
    }

    header('Location: ../vue/planning.php');
    exit();
}
?>
