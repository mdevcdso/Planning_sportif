<?php
// Connexion à la base de données
require_once('../modele/config.php');

class Utilisateur {
    private $id_utilisateur;
    private $nom_utilisateur;
    private $prenom_utilisateur;
    private $email_utilisateur;
    private $mot_de_passe;
    private $role;

    // Constructeur
    public function __construct($nom, $prenom, $email, $motDePasse, $role) {
        $this->nom_utilisateur = $nom;
        $this->prenom_utilisateur = $prenom;
        $this->email_utilisateur = $email;
        $this->mot_de_passe = $motDePasse;
        $this->role = $role;
    }

    public static function verifierConnexion($email, $motDePasse) {
        $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        
        $query = "SELECT * FROM Utilisateurs WHERE email_utilisateur = :email";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            // La vérification a réussi
            return true;
        } else {
            // La vérification a échoué
            return false;
        }
    }

    function getIdUser() {
        // Vérifiez si l'utilisateur est connecté
        if (isset($_SESSION['id_compte'])) {
            $id_compte = $_SESSION['id_compte'];
    
            // Récupérez l'ID de l'utilisateur à partir de la base de données
            global $connexion; // Déclarez la variable $connexion comme globale ici
            $requete = "SELECT id_utilisateur FROM compte WHERE id_compte = :id_compte";
            $statement = $connexion->prepare($requete);
            $statement->execute([':id_compte' => $id_compte]);
            $id_utilisateur = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $id_utilisateur['id_utilisateur'];
        }
    
        return null;
    }
    
    public static function getPrenomUtilisateurConnecte() {
        
        if (isset($_SESSION['prenom_utilisateur'])) {
            return $_SESSION['prenom_utilisateur'];
        }

        return ''; // Si le prénom n'est pas défini dans la session
    }
    
    function GetUser($email,$mdp)
    {
        $connexion = connexion("localhost","root", "","planning");
        // Requête SQL pour vérifier les informations de connexion
        $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = :email");
        $requete->execute([":email" => $email]);
        $utilisateur = $requete->fetch();
    
        if ($utilisateur['email_utilisateur'] && password_verify($mdp, $utilisateur["mot_de_passe"])){
            return true;
        }
        else 
        {
            return false;
        }
    }
}
