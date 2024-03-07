<?php
class Planning {
    private $id_planning;

    // Constructeur
    public function __construct() {
        // Initialisations éventuelles
    }

    // Getters et Setters
    public function getIdPlanning() {
        return $this->id_planning;
    }

    public function setIdPlanning($idPlanning) {
        $this->id_planning = $idPlanning;
    }

    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->id_utilisateur = $idUtilisateur;
    }

    public static function createPlanning() {
        $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

        // Créer un nouvel objet Planning et l'insérer dans la base de données
        $query = "INSERT INTO planning () VALUES ()";
        $connexion->exec($query);

        // Récupérer l'identifiant du planning nouvellement créé
        $idPlanning = $connexion->lastInsertId();

        // Retournez l'objet Planning créé
        return new self($idPlanning);
    }

    public static function getPlanningById($idPlanning) {
        $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

        // Récupérer un objet Planning par son identifiant
        $query = "SELECT * FROM planning WHERE id_planning = :idPlanning";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':idPlanning', $idPlanning, PDO::PARAM_INT);
        $stmt->execute();

        // Retournez l'objet Planning trouvé
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new self($row['id_planning']);
        }

        // Pour l'exemple, retournons null
        return null;
    }

}
?>
