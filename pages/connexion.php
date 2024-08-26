<?php 

    include_once __DIR__ . '/../classes/connexionDB.php';
?>

<section>
    <h2>Formulaire de connexion</h2>
    <form  method="post">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Se connecter">
    </form>

    <?php if (isset($error_message) && !empty($error_message)): ?>
        <p style="color: red;"><?= $error_message; ?></p>
    <?php endif; ?>

</section>
