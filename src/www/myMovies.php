<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : myMovies.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 03 juin 2020
 * Description    : Page où se trouvent les films créés par l'utilisateur connecté
 * Version        : 1.0
 */

 /**
  * @brief Sur cette page s'affichent les films créés par l'utilisateur connecté.
  */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged()) {
  header('Location: login.php');
}

$movies = MovieManager::getMoviesCreatedByUserLogged();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Page de mes films</title>
</head>

<body>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
  <div class="container">
    <?php
    if (!isset($movies[0])) {
      showWarning('Vous n\'avez créé aucun film. <a href="createMovie.php">Cliquez ici pour en créer un !</a>');
    }
    foreach ($movies as $movie) {
    ?>
      <div class="d-inline-block">
        <div class="card m-3" style="width: 18rem;">
          <a href="updateMovie.php?movieId=<?= $movie->Id ?>"><img src="<?= $movie->Poster ?>" class="card-img-top" alt="movie"></a>
          <div class="card-body">
            <a href="updateMovie.php?movieId=<?= $movie->Id ?>">
              <h5 class="card-title"><?= $movie->Title ?></h5>
            </a>
            <p class="card-text"><?= "Note moyenne : " . CodeManager::getAvgRatingByMovieId($movie->Id) . "/10" ?></br><?= "Nombre de votes : " . CodeManager::getNumberRatingsByMovieId($movie->Id) ?></p>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php'; ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>