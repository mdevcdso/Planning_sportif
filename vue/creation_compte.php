<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>

    <link rel="stylesheet" href="../vue/planning.php">
    <link rel="stylesheet" href="../vue/styles.css">
</head>
<body>
    <div class="container3">
        <div class="login wrap">
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
                
                <label for="Adresse_email" style="display: block; margin-top: 1rem;">
                    Adresse email :
                    <input type="email" name="email" required style="width: 20rem; height: 1.5rem;">
                </label>

                <label for="Mot de passe">
                    Mot de passe : 
                    <input type="password" name="mdp" required style="width: 20rem; height: 1.5rem;">
                </label>

                <label for="Confirmation Mot de passe">
                    Confirmation du mot de passe : 
                    <input type="password" name="confirmer_mot_de_passe" required style="width: 20rem; height: 1.5rem;">
                </label>

                <label for="Role">
                    Rôle : 
                    <select name="role" id="Role">
                        <option value="Organisateur">Organisateur</option>
                        <option value="Visionneur">Visionneur</option>
                    </select>
                </label>

                <label for="Sport" style="display: block; margin-top: 1rem;">
                    Sport de préférence : 
                    <select name="sport" id="Sport">
                        <?php
                            // Inclure la configuration de la base de données ici
                            require_once '../modele/config.php';
                            require_once '../modele/sport.php';

                            // Sélectionner tous les sports depuis la table Sport
                            $result = Sport::getNomsSports();

                            // Boucler à travers les résultats et créer une option pour chaque sport
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['nom_sport'] . '">' . $row['nom_sport'] . '</option>';
                            }

                            // Fermer la connexion à la base de données
                            $connexion = null;
                        ?>
                    </select>
                </label>
                
                <div style="display: flex; justify-content: space-around; align-items: baseline;">
                    <input type="submit" value="Créer le compte" class="btn" style="width: auto;">
                    <a href="../vue/connexion.php" style="margin-left: 0.5rem; color: white;">Connexion</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$prenom;
$nom;
$genre;
$email;
$mdp;
$confirmerMotDePasse;
$role;
$sport;
?>