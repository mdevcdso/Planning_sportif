<?php
require_once '../modele/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $id_match = $_POST['id_match'];

    // Ajoutez la logique pour supprimer le match de la base de données
    // ...

    // Redirigez vers la page du planning après la suppression du match
    header('Location: planning.php');
    exit();
}
?>
