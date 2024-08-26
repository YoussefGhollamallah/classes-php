<section>

    <?php include_once "../classes/User.php"; ?>

    <h2>Formulaire d'inscription</h2>   
    <form action="" method="post">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" id="firstname" required><br><br>

        <label for="lastname">Nom :</label>
        <input type="text" name="lastname" id="lastname" required><br><br>

        <input type="submit" value="S'inscrire">
    </form>
</section>