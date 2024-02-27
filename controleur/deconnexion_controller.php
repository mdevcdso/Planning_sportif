<?php
// login_controller.php
require_once '../modele/config.php';

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('Location: ../vue/connexion.php');
exit();
?>
