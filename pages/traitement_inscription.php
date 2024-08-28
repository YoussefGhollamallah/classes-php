<?php
// Paramètres de connexion à la base de données
$host = 'localhost';      // Remplace par ton hôte MySQL
$username = 'root';       // Remplace par ton nom d'utilisateur MySQL
$password = 'root';           // Remplace par ton mot de passe MySQL
$dbname = 'classes';      // Remplace par le nom de ta base de données

// Créer une connexion à la base de données
$connection = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($connection->connect_error) {
    die('Erreur de connexion : ' . $connection->connect_error);
}

// Inclure les fichiers nécessaires
require_once(__DIR__ . '/../classes/User.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier que les mots de passe correspondent
    if ($password === $confirm_password) {
        // Créer une nouvelle instance de la classe User
        $user = new User($connection, $login, $password, $email, $firstname, $lastname);

        // Inscrire l'utilisateur
        if ($user->register()) {
            // Stocker un message de succès dans la session
            session_start();
            $_SESSION['message'] = "Votre compte a été créé avec succès !";
            // Rediriger vers la page d'accueil
            header("Location: ../index.php?page=index");
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}

// Fermer la connexion
$connection->close();
?>
