<section>

    <h2>Résultat de l'inscription</h2>
    
    <?php
    

    // Récupération du paramètre de la requête
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        
        if ($status === 'success') {
            echo "<p>Votre inscription a été réussie !</p>";
        } elseif ($status === 'error') {
            echo "<p>Le login ou l'email est déjà utilisé. Veuillez essayer avec des informations différentes.</p>";
        } else {
            echo "<p>Une erreur est survenue. Veuillez réessayer.</p>";
        }
    } else {
        echo "<p>Accès direct à la page non autorisé.</p>";
    }
    ?>
    
    <a href="inscription.php">Retour au formulaire d'inscription</a>
</section>