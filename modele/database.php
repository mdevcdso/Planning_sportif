<?php

    require "../modele/config.php";

    $connexion = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);

    function connexion($serveur,$utilisateur,$motDePasse,$bdd) {

        $estConnecte = false;
        
        try {
            $connexion = new PDO("mysql:host=$serveur;dbname=$bdd",$utilisateur,$motDePasse);
        } catch(PDOException $e) {
            die("Erreur de connexion : ".$e->getMessage());
        }
        return $connexion;
    }
    
