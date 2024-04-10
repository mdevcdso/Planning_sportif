<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link rel="stylesheet" href="../vue/planning.php">
    <link rel="stylesheet" href="../vue/styles.css">
</head>
<body>
    <div class="container">
        <div class="login wrap">
            <h1>
                Connexion
            </h1>
            <form action="../controleur/connexion_controller.php" method="POST" name="connexion">
                <label for="Adresse_email">
                    Adresse email
                    <input type="email" name="email" required style="width: 20rem; height: 1.5rem;">
                </label>
                
                <label for="Mot de passe">
                    Mot de passe : 
                    <input type="password" name="mdp" required style="width: 20rem; height: 1.5rem;">
                    <button type="button" class="afficher_mdp" onclick="togglePasswordVisibility()" style="margin-right: 20px;">
                        <img src="../img/oeil.png" alt="oeil">
                    </button>
                    <a href="../vue/parametres.php" style="color: white; font-size: 13px;">Mot de passe oublié</a>
                </label>
                
                <div style="display: flex; justify-content: space-around; align-items: baseline;">
                    <input type="submit" value="Se connecter" class="btn" style="width: auto;">
                    <a href="../vue/creation_compte.php" style="margin-left: 0.5rem; color: white;">Inscription</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var newPasswordInput = document.querySelector("input[name='mdp']");

            // Basculer le type entre "password" et "text"
            newPasswordInput.type = newPasswordInput.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
<?php
    $email;
    $mdp;
?>