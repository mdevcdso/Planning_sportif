<?php
require_once '../modele/config.php';

class Matchs {
    private $id_matchs;
    private $titre;
    private $duree;
    private $date_match;
    private $lieu_match;
    private $description_match;
    private $score;

    // Constructeur
    public function __construct($titre, $duree, $dateMatch, $lieuMatch, $description, $score) {
        $this->titre = $titre;
        $this->duree = $duree;
        $this->date_match = $dateMatch;
        $this->lieu_match = $lieuMatch;
        $this->description_match = $description;
        $this->score = $score;
    }

    // Getters et Setters
    public static function getMatchs() {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM matchs";
        $stmt = $bdd->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function groupMatchsByDate($matchs) {
        $groupedMatchs = [];
        
        foreach ($matchs as $match) {
            $date = date('Y-m-d', strtotime($match['date_match']));
            $groupedMatchs[$date][] = $match;
        }
    
        return $groupedMatchs;
    }
    
    public static function getMatchById($id) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM matchs WHERE Id_Matchs = :id";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifierMatch($id, $nouvellesDonnees) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "UPDATE matchs SET titre = :titre, duree = :duree, date_match = :date_match, lieu_match = :lieu_match, description_match = :description_match, score = :score WHERE Id_Matchs = :id";
        
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $nouvellesDonnees['titre'], PDO::PARAM_STR);
        $stmt->bindParam(':duree', $nouvellesDonnees['duree'], PDO::PARAM_STR);
        $stmt->bindParam(':date_match', $nouvellesDonnees['date_match'], PDO::PARAM_STR);
        $stmt->bindParam(':lieu_match', $nouvellesDonnees['lieu_match'], PDO::PARAM_STR);
        $stmt->bindParam(':description_match', $nouvellesDonnees['description_match'], PDO::PARAM_STR);
        $stmt->bindParam(':score', $nouvellesDonnees['score'], PDO::PARAM_INT);

        $success = $stmt->execute();

        return $success;
    }   
    
    public static function supprimerMatch($id) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "DELETE FROM matchs WHERE Id_Matchs = :id";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
?>
