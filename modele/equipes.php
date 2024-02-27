<?php
require_once '../modele/config.php';

class Equipes {
    private $id_equipe;
    private $nom_equipe;
    private $nombre_joueurs;
    private $nom_entraineur;
    private $ratio;
    private $nombre_victoire;
    private $nombre_defaite;

    // Constructeur
    public function __construct($nomEquipe, $nombreJoueurs, $nomEntraineur, $ratio, $nombreVictoire, $nombreDefaite) {
        $this->nom_equipe = $nomEquipe;
        $this->nombre_joueurs = $nombreJoueurs;
        $this->nom_entraineur = $nomEntraineur;
        $this->ratio = $ratio;
        $this->nombre_victoire = $nombreVictoire;
        $this->nombre_defaite = $nombreDefaite;
    }

    // Getters et Setters
    public static function getEquipes() {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM equipes";
        $stmt = $bdd->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEquipeIdByName($nomEquipe) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT id_equipe FROM equipes WHERE nom_equipe = :nomEquipe";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':nomEquipe', $nomEquipe, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result) ? $result['id_equipe'] : null;
    }

    public static function getEquipesForMatch($matchId) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT equipes.nom_equipe FROM equipes JOIN participer ON equipes.id_equipe = participer.id_equipe WHERE participer.Id_Matchs = :matchId";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':matchId', $matchId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function supprimerEquipe($idEquipe) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "DELETE FROM equipes WHERE id_equipe = :idEquipe";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':idEquipe', $idEquipe, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
