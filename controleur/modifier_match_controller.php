<?php
// modifier_match_controller.php
require_once '../modele/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $id_match = $_POST['id_match'];
    // Récupérez les autres données nécessaires

    // Ajoutez la logique pour modifier le match dans la base de données
    // ...

    // Redirigez vers la page du planning après la modification du match
    header('Location: planning.php');
    exit();
}
?>
