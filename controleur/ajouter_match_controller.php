<?php
require_once '../modele/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $heure_match = $_POST['heure_match'];
    $lieu_match = $_POST['lieu_match'];
    $description_match = $_POST['description_match'];
    $score = $_POST['score'];

    // Ajoutez la logique pour insérer le match dans la base de données
    try {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        
        $query = "INSERT INTO matchs (titre, durée, heure_match, lieu_match, description_match, score) VALUES (:titre, :duree, :heure_match, :lieu_match, :description_match, :score)";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':heure_match', $heure_match);
        $stmt->bindParam(':lieu_match', $lieu_match);
        $stmt->bindParam(':description_match', $description_match);
        $stmt->bindParam(':score', $score);
        $stmt->execute();

        // Redirigez vers la page du planning après l'ajout du match
        header('Location: ../vue/planning.php');
        exit();
    } catch (PDOException $e) {
        // Gérez les erreurs liées à la base de données ici
        echo "Erreur : " . $e->getMessage();
    }
}
?>
