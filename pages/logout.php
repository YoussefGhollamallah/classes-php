<?php
session_start(); // Démarrer la session

// Détruire toutes les données de la session
session_unset();
session_destroy();

// Rediriger vers la page de connexion ou d'accueil
header('Location: index.php?page=index');
exit;
?>
