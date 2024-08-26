<?php

require_once "User.php";
// Démarrage de la session
session_start();

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connexion à la base de données
    $db = new mysqli('localhost', 'root', 'root', 'classes');

    // Vérification si la connexion a réussi
    if ($db->connect_error) {
        die("La connexion à la base de données a échoué : " . $db->connect_error);
    }

    // Récupération des données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Créez l'objet User pour la connexion
    $user = new User($db, $login, $password);
    

    // Tentative de connexion de l'utilisateur
    if ($user->connect($password)) {
        header("Location: pages/traitement.php");
        exit();
    } else {
        header("Location: connexion.php?status=error");
        exit();
    }

    // Fermeture de la connexion à la base de données
    $db->close();
}
?>
