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
}
?>
