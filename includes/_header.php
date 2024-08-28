
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <?php if (!isset($_SESSION['user_id'])): ?>
          <!-- Afficher les liens d'inscription et de connexion uniquement si l'utilisateur n'est pas connecté -->
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=inscription">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=connexion">Connexion</a>
          </li>
        <?php else: ?>
          <!-- Afficher les liens de profil et de déconnexion si l'utilisateur est connecté -->
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=profil">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
</header>
