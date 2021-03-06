<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : navbar.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Barre de navigation
 * Version        : 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Evaluation Films</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <?php
      if (!SessionManager::getIsLogged()) {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Connexion</a>
        </li>
      <?php
      } else {
      ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Gestion de films
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="createMovie.php">Créer un film</a>
            <a class="dropdown-item" href="myMovies.php">Modifier un film</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profil</a>
        </li>
        <?php if (SessionManager::getLoggedUser()->Role->Code == 2) { ?>
          <li class="nav-item">
            <a class="nav-link" href="userManagement.php">Gestion des utilisateurs</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Déconnexion</a>
        </li>
      <?php
      }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="help.php">?</a>
      </li>
    </ul>
  </div>
</nav>