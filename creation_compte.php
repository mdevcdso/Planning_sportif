<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>

    <link rel="stylesheet" href="planning.html">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-image: url(/img/fond-noir.jpg);">
    <div class="formulaire">
        <h1>
            Création de compte
        </h1>
        <form action="recupinfos.php" method="POST" name="creation_compte">
            <label for="Nom"> 
                Nom :
                <input type="text" name="nom" style="width: 20rem; height: 1.5rem;">
            </label>
            
            <label for="Prénom">
                Prénom : 
                <input type="text" name="prenom" style="width: 20rem; height: 1.5rem;">
            </label>
    
            <label for="Genre">
                Genre : 
                <select name="genre" id="Genre">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Autre">Autre</option>
                </select>
            </label>
            
            <label for="Adresse_email">
                Adresse email
                <input type="email" name="email" style="width: 20rem; height: 1.5rem;">
            </label>

            <label for="Role">
                Rôle : 
                <select name="role" id="Role">
                    <option value="Organisateur">Organisateur</option>
                    <option value="Visionneur">Visionneur</option>
                </select>
            </label>
            
            <label for="Mot de passe">
                Mot de passe : 
                <input type="password" name="Mdp" style="width: 20rem; height: 1.5rem;">
            </label>
            
            <div style="display: flex; justify-content: center; align-items: baseline;">
                <input type="submit" value="Envoyer" style="width: 5rem; height: 2rem;">
                <a href="connexion.html" style="margin-left: 0.5rem;">Connexion</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
$prenom;
$nom;
$genre;
$email;
$role;
$mdp;
?>