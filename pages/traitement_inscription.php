<?php
// Inclure le fichier où la classe User est définie
include 'User.php';

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
        $user = new User($login, $password, $email, $firstname, $lastname);

        // Ici, vous pouvez enregistrer l'utilisateur dans une base de données ou effectuer d'autres actions
        echo "Utilisateur créé avec succès !";
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>
