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

$movies = MovieManager::getAll();
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
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
  <div class="container">
    <table>
      <tr>
        <?php
        foreach ($movies as $movie) {
        ?>
        <td>
          <div class="card" style="width: 18rem;">
            <a href="movie.php?movieId=<?= $movie->Id ?>"><img src="<?= $movie->Poster ?>" class="card-img-top" alt="..."></a>
            <div class="card-body">
            <a href="movie.php?movieId=<?= $movie->Id ?>"><h5 class="card-title"><?= $movie->Title ?></h5></a>
              <p class="card-text"><?= "Note moyenne : " . CodeManager::getAvgRatingByMovieId($movie->Id) . "/10"?></br><?= "Nombre de votes : " . CodeManager::getNumberRatingsByMovieId($movie->Id)?></p>
            </div>
          </div>
        </td>
        <?php
        }
        ?>
      </tr>
    </table>
  </div>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php'; ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>