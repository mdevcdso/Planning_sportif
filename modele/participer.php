<?php
class Participer {
    private $id_matchs;
    private $id_equipe;

    // Constructeur
    public function __construct($idMatchs, $idEquipe) {
        $this->id_matchs = $idMatchs;
        $this->id_equipe = $idEquipe;
    }

    // Getters et Setters
    public function getIdMatchs() {
        return $this->id_matchs;
    }

    public function getIdEquipe() {
        return $this->id_equipe;
    }

    public function setIdMatchs($idMatchs) {
        $this->id_matchs = $idMatchs;
    }

    public function setIdEquipe($idEquipe) {
        $this->id_equipe = $idEquipe;
    }

    public static function supprimerParticipationsPourMatch($idMatchs) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "DELETE FROM participer WHERE Id_Matchs = :idMatchs";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':idMatchs', $idMatchs, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
