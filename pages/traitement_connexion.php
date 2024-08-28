<?php
session_start(); 

// Paramètres de connexion à la base de données
$host = 'localhost';      
$username = 'root';      
$password = 'root';          
$dbname = 'classes';     

// Créer une connexion à la base de données
$connection = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($connection->connect_error) {
    die('Erreur de connexion : ' . $connection->connect_error);
}

require_once(__DIR__ . '/../classes/User.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Préparer la requête pour récupérer l'utilisateur avec prénom et nom
    $stmt = $connection->prepare("SELECT id, password, firstname, lastname FROM utilisateurs WHERE login = ?");
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // L'utilisateur existe, vérifier le mot de passe
        $stmt->bind_result($user_id, $hashed_password, $firstname, $lastname);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Connexion réussie
            $_SESSION['user_id'] = $user_id;           // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['login'] = $login;               // Stocker le login dans la session
            $_SESSION['firstname'] = $firstname;       // Stocker le prénom dans la session
            $_SESSION['lastname'] = $lastname;         // Stocker le nom dans la session
            
            header("Location: ../index.php?page=profil");
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    $stmt->close();
}

// Fermer la connexion
$connection->close();
?>
