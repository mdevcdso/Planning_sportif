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

    // Getters et Setters
    // ...

    // Méthodes CRUD
    // ...
}
?>
