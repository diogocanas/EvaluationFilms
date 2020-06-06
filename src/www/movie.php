<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : movie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Page de détail du film
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (isset($_GET['movieId'])) {
    $movieId = $_GET['movieId'];
} else {
    header('Location: index.php');
}

$movie = MovieManager::getById($movieId);
$links = getLinks($movie->Links);
$ratings = CodeManager::getRatingsByMovieId($movieId);

$rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
$remark = filter_input(INPUT_POST, 'remark', FILTER_SANITIZE_STRING);
$rateButton = filter_input(INPUT_POST, 'rate');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Page de détail du film</title>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
    <div class="container m-auto row center w-100">
        <?php
        if (isset($rateButton)) {
            if (!empty($rating)) {
                if ($rating >= 0 && $rating <= 10) {
                    if (CodeManager::addRateToMovie($movie->Id, $rating, $remark)) {
                        header('Location: movie.php?movieId=' . $movie->Id);
                    } else {
                        showError("La notation du film a échoué.");
                    }
                } else {
                    showError("La note doit être entre 0 et 10.");
                }
            }
        }
        ?>
        <div class="col-8 row">
            <?php
            echo '<img src="' . $movie->Poster . '" width="250" class="col-6">';
            echo '<div class="col-6 w-50">';
            echo '<h1>' . $movie->Title . '</h1>';
            echo "Genre : " . $movie->Gender->Label . '</br>';
            echo "Réalisateur : " . $movie->Director->Director . '</br>';
            echo "Acteurs principaux : </br><ul>";
            foreach ($movie->Actors as $actor) {
                echo '<li>' . $actor->Actor . '</li>';
            }
            echo "</ul>Société de production : " . $movie->Company->Company . '</br>';
            echo "Pays d'origine : " . $movie->Country->Country . '</br>';
            echo "Année de sortie : " . $movie->ReleaseYear . '</br>';
            echo "Durée du film : " . $movie->Duration . ' minutes</br></br>';
            echo "Note moyenne : " . CodeManager::getAvgRatingByMovieId($movie->Id) . "/10</br>";
            echo "Nombre de votes : " . CodeManager::getNumberRatingsByMovieId($movieId);
            echo '</div>';
            echo '<div class="ml-3"><h2 class="m-0">Description</h2></br>';
            echo $movie->Description . '</div>';
            ?>

        </div>
        <div class="col-4">
            <h1>Liens et vidéos</h1>
            <?php 
            foreach ($links as $link) {
                echo '<a href="' . $link . '" target="_blank">' . $link . '</a></br>';
            }
            foreach ($movie->Medias as $media) {
                if (strpos($media->Media, 'image')) {
                    echo '<img src="' . $media->Media . '" width="250"></br>';
                } else if (strpos($media->Media, 'video')) {
                    echo '<video width="250" controls><source src="' . $media->Media . '"></video>';
                } else if (strpos($media->Media, 'audio')) {
                    echo '<audio controls><source src="' . $media->Media . '"></audio>';
                }
            }
            echo '<h2>Commentaires</h2>';
            foreach ($ratings as $rating) {
                echo $rating->Remark . '</br>';
            }
            ?>
        </div>
        <?php
        if (CodeManager::alreadyRated($movieId) && SessionManager::getIsLogged()) {
        ?>
            <form method="POST" action='' class="w-25 ml-3">
                <div class="form-group">
                    <label for="rating">Noter le film (de 0 à 10)</label>
                    <input type="number" min="0" max="10" class="form-control" id="rating" name="rating">
                </div>
                <div class="form-group">
                    <label for="remark">Commentaires</label>
                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="rate">Noter le film</button>
            </form>
        <?php } ?>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>