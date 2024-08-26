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
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Création de l'objet User
    $user = new User($db, $login, $password, $email, $firstname, $lastname);

    // Tentative d'inscription de l'utilisateur
    if ($user->register()) {
        header("Location: pages/traitement.php?status=success");
        exit();
    } else {
        header("Location: inscription.php?status=error");
        exit();
    }

    // Fermeture de la connexion à la base de données
    $db->close();
}
?>
