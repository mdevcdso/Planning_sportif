<?php
class Sport {
    private $id_sport;
    private $nom_sport;

    // Constructeur
    public function __construct($nomSport) {
        $this->nom_sport = $nomSport;
    }

    // Getters et Setters
    public static function getNomsSports() {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT Id_Sport, nom_sport FROM sport";
        $stmt = $bdd->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
