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
    // Méthodes CRUD
    // ...
}
?>
