<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du compte</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div class="login wrap">
        <h1 style="margin-bottom: 4rem;">Paramètres du compte</h1>
        
        <form action="../controleur/modifier_mot_de_passe.php" method="POST" onsubmit="return validatePasswords()">
            <div class="password-container">
                <div>
                    <label for="nouveau_mot_de_passe">Nouveau mot de passe :</label>
                    <input type="password" name="nouveau_mot_de_passe" required>

                    <label for="confirmer_mot_de_passe">Confirmer le nouveau mot de passe :</label>
                    <input type="password" name="confirmer_mot_de_passe" required>
                </div>

                <button type="button" class="afficher_mdp" onclick="togglePasswordVisibility()">
                    <img src="../img/oeil.png" alt="oeil">
                </button>
            </div>

            <input type="submit" class="btn" value="Modifier le mot de passe">
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            var newPasswordInput = document.querySelector("input[name='nouveau_mot_de_passe']");
            var confirmPasswordInput = document.querySelector("input[name='confirmer_mot_de_passe']");

            // Basculer le type entre "password" et "text"
            newPasswordInput.type = newPasswordInput.type === "password" ? "text" : "password";
            confirmPasswordInput.type = confirmPasswordInput.type === "password" ? "text" : "password";
        }

        function validatePasswords() {
            var newPassword = document.querySelector("input[name='nouveau_mot_de_passe']").value;
            var confirmPassword = document.querySelector("input[name='confirmer_mot_de_passe']").value;

            // Vérifier si les deux mots de passe sont identiques
            if (newPassword !== confirmPassword) {
                alert("Les mots de passe ne correspondent pas. Veuillez les saisir à nouveau.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
