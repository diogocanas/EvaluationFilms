<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : index.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Page d'accueil du site
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

$movies = CodeManager::getMostRatedMovies();
$genders = CodeManager::getAllGenders();
$countries = CodeManager::getAllCountries();

$keywordFilter = filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING);
$genderFilter = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
$releaseYearStartFilter = filter_input(INPUT_POST, 'releaseYearStart', FILTER_VALIDATE_INT);
$releaseYearEndFilter = filter_input(INPUT_POST, 'releaseYearEnd', FILTER_VALIDATE_INT);
$countryFilter = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
$durationStartFilter = filter_input(INPUT_POST, 'durationStart', FILTER_VALIDATE_INT);
$durationEndFilter = filter_input(INPUT_POST, 'durationEnd', FILTER_VALIDATE_INT);
$filterButton = filter_input(INPUT_POST, 'filter');
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Page d'accueil</title>
</head>

<body>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php';
  if (isset($movies[0])) {
  ?>
    <form method="POST" action="index.php" class="m-4 d-flex justify-content-between">
      <div class="form-group d-inline-block">
        <label for="keyword">Mots-clés</label>
        <input class="form-control" type="text" id="keyword" name="keyword" value="<?= $keywordFilter ?>" />
      </div>
      <div class="form-group d-inline-block">
        <label for="gender">Genre</label>
        <select class="form-control" id="gender" name="gender">
          <option>Tout</option>
          <?php
          foreach ($genders as $gender) {
          ?>
            <option <?php if ($gender->Label == $genderFilter) echo 'selected'; ?>><?= $gender->Label ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="form-group d-inline-block">
        <b><label>Année de sortie</label></b>
        <label for="releaseYearStart">De</label>
        <input class="form-control" type="number" id="releaseYearStart" name="releaseYearStart" value="<?= $releaseYearStartFilter ?>" />
      </div>
      <div class="form-group d-inline-block">
        <label for="releaseYearEnd">À</label>
        <input class="form-control" type="number" id="releaseYearEnd" name="releaseYearEnd" value="<?= $releaseYearEndFilter ?>" />
      </div>
      <div class="form-group d-inline-block">
        <label for="country">Pays</label>
        <select class="form-control" id="country" name="country">
          <option selected>Tout</option>
          <?php
          foreach ($countries as $country) {
          ?>
            <option <?php if ($country->Country == $countryFilter) echo 'selected' ?>><?= $country->Country ?></option>;
          <?php
          }
          ?>
        </select>
      </div>
      <div class="form-group d-inline-block">
        <b><label>Durée (en minutes)</label></b>
        <label for="durationStart">De</label>
        <input class="form-control" type="number" id="durationStart" name="durationStart" value="<?= $durationStartFilter ?>" />
      </div>
      <div class="form-group d-inline-block">
        <label for="durationEnd">À</label>
        <input class="form-control" type="number" id="durationEnd" name="durationEnd" value="<?= $durationEndFilter ?>" />
      </div>
      <button type="submit" class="btn btn-primary h-25 mt-4" name="filter">Filtrer</button>
    </form>
  <?php } ?>
  <div class="container">
    <?php
    if (isset($filterButton)) {
      $movies = MovieManager::filter($keywordFilter, $genderFilter, $releaseYearStartFilter, $releaseYearEndFilter, $countryFilter, $durationStartFilter, $durationEndFilter);
    }
    if (!isset($movies[0])) {
      showWarning('Aucun film n\'est disponible. <a href="createMovie.php">Cliquez ici pour en créer un !</a>');
    }
    foreach ($movies as $movie) {
    ?>
      <div class="d-inline-block">
        <div class="card m-3" style="width: 18rem;">
          <a href="movie.php?movieId=<?= $movie->Id ?>"><img src="<?= $movie->Poster ?>" class="card-img-top" alt="movie"></a>
          <div class="card-body">
            <a href="movie.php?movieId=<?= $movie->Id ?>">
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
  <a href="allMovies.php" class="ml-2">Voir tous les films</a>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php'; ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>