<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css?<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   

    <title>Document</title>
</head>
<body>
    <?php

      require_once (__DIR__ . "/includes/_header.php" ) ;

    ?>
  <main>
        <?php
        // Définit la page par défaut
        $page = isset($_GET['page']) ? $_GET['page'] : 'index';

        // Chemin du fichier correspondant à la page
        $file = __DIR__ . "/pages/" . $page . ".php";

        // Vérifie si le fichier existe, sinon, affiche une erreur
        if (file_exists($file)) {
            require_once($file);
        } else {
            echo "<h1>Bienvenue sur mon site</h1>";
        }
        ?>
    </main>
    <?php

    require_once ( __DIR__ . "/includes/_footer.php")
    ?>
   <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
