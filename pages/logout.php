<?php

// Inclure le fichier de la classe User
require_once 'classes/User.php';

// Connexion à la base de données
$db = new mysqli('localhost', 'root', 'root', 'classes');

// Vérifier la connexion
if ($db->connect_error) {
    die("Échec de la connexion : " . $db->connect_error);
}

// Instancier l'utilisateur avec la connexion
$user = new User($db);
$user->disconnect();

// Rediriger vers la page de connexion ou d'accueil
header('Location: index.php?page=index');
exit;
?>
