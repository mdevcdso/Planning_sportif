<?php
    //Configuration de la connexion a la bdd
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "";
    $bdd = "planning";

    $estConnecte = false;
    
    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$bdd",$utilisateur,$motDePasse);
    } catch(PDOException $e) {
        die("Erreur de connexion : ".$e->getMessage());
    }
?>