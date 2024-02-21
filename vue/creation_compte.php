<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>

    <link rel="stylesheet" href="/vue/planning.php">
    <link rel="stylesheet" href="/vue/styles.css">
</head>
<body>
    <div class="formulaire">
        <h1>
            Création de compte
        </h1>
        <form action="../controleur/creation_compte_controller.php" method="POST" name="creation_compte">
            <label for="Nom"> 
                Nom :
                <input type="text" name="nom" required style="width: 20rem; height: 1.5rem;">
            </label>
            
            <label for="Prénom">
                Prénom : 
                <input type="text" name="prenom" required style="width: 20rem; height: 1.5rem;">
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
                <input type="email" name="email" required style="width: 20rem; height: 1.5rem;">
            </label>

            <label for="Mot de passe">
                Mot de passe : 
                <input type="password" name="mdp" required style="width: 20rem; height: 1.5rem;">
            </label>

            <label for="Role">
                Rôle : 
                <select name="role" id="Role">
                    <option value="Organisateur">Organisateur</option>
                    <option value="Visionneur">Visionneur</option>
                </select>
            </label>

            <label for="Sport">
                Sport(s) de préférence : 
                <select name="sport" id="Sport">
                    <option value="Football">Football</option>
                    <option value="Basketball">Basketball</option>
                    <option value="Rugby">Rugby</option>
                    <option value="Hockey_sur_glace">Hockey sur glace</option>
                    <option value="Volley-ball">Volley-ball</option>
                    <option value="Handball">Handball</option>
                    <option value="Polo">Polo</option>
                    <option value="Ultimate_Frisbee">Ultimate Frisbee</option>
                    <option value="Quidditch">Quidditch</option>
                </select>
            </label>
            
            <div style="display: flex; justify-content: center; align-items: baseline;">
                <input type="submit" value="Créer le compte" style="width: auto; height: 2rem;">
                <a href="/vue/connexion.html" style="margin-left: 0.5rem;">Connexion</a>
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
$mdp;
$role;
$sport;
?>