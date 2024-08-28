<?php

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si non connecté
    header('Location: index.php?page=profil');
    exit;
}

// Code pour la page sécurisée

echo "Bienvenue, " . htmlspecialchars($_SESSION['firstname']) . " " . htmlspecialchars($_SESSION['lastname']) .  "!";
?>
