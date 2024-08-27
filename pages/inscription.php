<?php 

require_once (__DIR__. "/../includes/_header.php");

?>


<section id="form-inscription">
    
    <form  action="traitement_inscription.php" method="post">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="firstname">Prénom :</label>
        <input type="text" id="firstname" name="firstname" required><br><br>
        
        <label for="lastname">Nom :</label>
        <input type="text" id="lastname" name="lastname" required><br><br>
        
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Confirmez le mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" value="S'inscrire">
    </form>
    
</section>
    
    <?php 

require_once (__DIR__ . "/../includes/_footer.php");

?>