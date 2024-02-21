<?php
class Compte {
    private $id_compte;
    private $sport_choisi;
    private $id_utilisateur;

    // Constructeur
    public function __construct($sportChoisi, $idUtilisateur) {
        $this->sport_choisi = $sportChoisi;
        $this->id_utilisateur = $idUtilisateur;
    }

    // Getters et Setters
    // ...

    // Méthodes CRUD
    // ...
}
?>
