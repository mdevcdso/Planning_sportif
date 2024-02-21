<?php
class Matchs {
    private $id_matchs;
    private $titre;
    private $duree;
    private $heure_match;
    private $lieu_match;
    private $description_match;
    private $score;

    // Constructeur
    public function __construct($titre, $duree, $heureMatch, $lieuMatch, $description, $score) {
        $this->titre = $titre;
        $this->duree = $duree;
        $this->heure_match = $heureMatch;
        $this->lieu_match = $lieuMatch;
        $this->description_match = $description;
        $this->score = $score;
    }

    // Getters et Setters
    // ...

    // Méthodes CRUD
    // ...
}
?>
