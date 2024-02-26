<?php
require_once '../modele/config.php';

class Joueurs {
    private $id_joueur;
    private $nom_joueurs;
    private $prenom_joueur;
    private $age_joueur;
    private $role;
    private $id_equipe;

    // Constructeur
    public function __construct($nomJoueur, $prenomJoueur, $ageJoueur, $role, $idEquipe) {
        $this->nom_joueurs = $nomJoueur;
        $this->prenom_joueur = $prenomJoueur;
        $this->age_joueur = $ageJoueur;
        $this->role = $role;
        $this->id_equipe = $idEquipe;
    }

    // Getters et Setters
    public static function getJoueurs() {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM joueurs";
        $stmt = $bdd->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthodes CRUD
    // ...
}
?>
