<?php
class Posseder {
    private $id_compte;
    private $id_planning;

    // Constructeur
    public function __construct($idCompte, $idPlanning) {
        $this->id_compte = $idCompte;
        $this->id_planning = $idPlanning;
    }

    // Getters et Setters
    public function getIdCompte() {
        return $this->id_compte;
    }

    public function setIdCompte($idCompte) {
        $this->id_compte = $idCompte;
    }

    public function getIdPlanning() {
        return $this->id_planning;
    }

    public function setIdPlanning($idPlanning) {
        $this->id_planning = $idPlanning;
    }

    public static function createPossession($idCompte, $idPlanning) {
        $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

        // Récupérer l'id du planning
        $idPlanning = $planning->getIdPlanning();

        // Insérer une nouvelle association dans la table "posseder"
        $query = "INSERT INTO posseder (id_compte, id_planning) VALUES (:idCompte, :idPlanning)";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
        $stmt->bindParam(':idPlanning', $idPlanning, PDO::PARAM_INT);
        $stmt->execute();

        // Retournez l'objet Posseder créé
        return new self($idCompte, $idPlanning);
    }

    public static function getPossederByIdCompte($idCompte) {
        $connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

        // Récupérer les associations posseder pour un compte donné
        $query = "SELECT * FROM posseder WHERE id_compte = :idCompte";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
        $stmt->execute();

        // Retournez une liste d'objets Posseder
        $possederList = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $possederList[] = new self($row['id_compte'], $row['id_planning']);
        }

        return $possederList;
    }
}
?>
