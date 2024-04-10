<?php
class Concerner {
    private $id_matchs;
    private $id_sport;

    // Constructeur
    public function __construct($idMatchs, $idSport) {
        $this->id_matchs = $idMatchs;
        $this->id_sport = $idSport;
    }

    // Dans concerner.php
    public static function supprimerConcernerPourMatch($idMatch) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "DELETE FROM concerner WHERE Id_Matchs = :idMatch";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);
        $stmt->execute();
    }

}
?>
