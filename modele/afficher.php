<?php
class Afficher {
    private $id_planning;
    private $id_matchs;
    private $date_match;

    // Constructeur
    public function __construct($idPlanning, $idMatchs, $dateMatch) {
        $this->id_planning = $idPlanning;
        $this->id_matchs = $idMatchs;
        $this->date_match = $dateMatch;
    }

    // Dans afficher.php
    public static function supprimerAffichagePourMatch($idMatch) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "DELETE FROM afficher WHERE Id_Matchs = :idMatch";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);
        $stmt->execute();
    }

}
?>
