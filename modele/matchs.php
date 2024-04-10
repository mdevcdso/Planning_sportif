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

    public static function getMatchByCriteria($titre = null, $dateMatch = null, $equipeMatch = null) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        // Initialisation de la requête avec des jointures conditionnelles
        $query = "SELECT DISTINCT m.* FROM Matchs m";
        $params = [];
        $conditions = [];
        
        // Ajout conditionnel des jointures et des conditions en fonction des critères fournis
        if (!is_null($dateMatch) || !is_null($equipeMatch)) {
            $query .= " LEFT JOIN Afficher a ON m.Id_Matchs = a.Id_Matchs";
            $query .= " LEFT JOIN Participer p ON m.Id_Matchs = p.Id_Matchs";
            $query .= " LEFT JOIN Equipes e ON p.id_equipe = e.id_equipe";
        }
        
        // Filtrage par titre si fourni
        if (!is_null($titre)) {
            $conditions[] = "m.titre LIKE :titre";
            $params[':titre'] = "%$titre%";
        }
        
        // Filtrage par date si fournie
        if (!is_null($dateMatch)) {
            $conditions[] = "a.date_match = :date_match";
            $params[':date_match'] = $dateMatch;
        }
        
        // Filtrage par nom d'équipe si fourni
        if (!is_null($equipeMatch)) {
            $conditions[] = "e.nom_equipe LIKE :nom_equipe";
            $params[':nom_equipe'] = "%$equipeMatch%";
        }
        
        // S'il existe des conditions, les ajouter à la requête
        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        
        $stmt = $bdd->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMatchByTitre($titre) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM matchs WHERE titre LIKE :titre";
        $stmt = $bdd->prepare($query);
        $likeTitre = "%" . $titre . "%";
        $stmt->bindParam(':titre', $likeTitre, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public static function getLastInsertedMatchId() {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT MAX(Id_Matchs) AS last_inserted_id FROM matchs";
        $stmt = $bdd->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['last_inserted_id']) ? $result['last_inserted_id'] : null;
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
        $stmt->bindParam(':score', $nouvellesDonnees['score'], PDO::PARAM_STR);

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

    public static function saisirScores($id, $score) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "UPDATE matchs SET score = :score WHERE Id_Matchs = :id";
        
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':score', $score, PDO::PARAM_STR);

        return $stmt->execute();
    }
    
}
?>
