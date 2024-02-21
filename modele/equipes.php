<?php
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
    // ...

    // Méthodes CRUD
    // ...
}
?>
