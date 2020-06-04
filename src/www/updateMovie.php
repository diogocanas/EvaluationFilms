<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : updateMovie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 03 juin 2020
 * Description    : Page de modification de film
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged()) {
    header('Location: index.php');
}

if (isset($_GET['movieId'])) {
    $movieId = $_GET['movieId'];
} else {
    header('Location: myMovies.php');
}

$movie = MovieManager::getById($movieId);

$genders = CodeManager::getAllGenders();
$actors = CodeManager::getAllActors();
$directors = CodeManager::getAllDirectors();
$companies = CodeManager::getAllCompanies();
$countries = CodeManager::getAllCountries();

$gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$firstActor = filter_input(INPUT_POST, 'firstActor', FILTER_SANITIZE_STRING);
$secondActor = filter_input(INPUT_POST, 'secondActor', FILTER_SANITIZE_STRING);
$thirdActor = filter_input(INPUT_POST, 'thirdActor', FILTER_SANITIZE_STRING);
$director = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_STRING);
$company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
$releaseYear = filter_input(INPUT_POST, 'releaseYear', FILTER_VALIDATE_INT);
$durationHours = filter_input(INPUT_POST, 'durationHours', FILTER_VALIDATE_INT);
$durationMinutes = filter_input(INPUT_POST, 'durationMinutes', FILTER_VALIDATE_INT);
$links = filter_input(INPUT_POST, 'links', FILTER_SANITIZE_STRING);
$hideButton = filter_input(INPUT_POST, 'hide');
$updateButton = filter_input(INPUT_POST, 'update');
$deleteButton = filter_input(INPUT_POST, 'delete');

$actorsArray = array($firstActor, $secondActor, $thirdActor);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Page de modification de films</title>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
    <div class="container overflow-hidden p-0">
        <?php
        // Pour cacher le film
        if (isset($hideButton)) {
            if (MovieManager::hideMovie($movie)) {
                header('Location: updateMovie.php?movieId=' . $movieId);
            }
        }

        // Pour modifier le film
        if (isset($updateButton)) {
            if (!empty($gender) && !empty($title) && !empty($description) && !empty($firstActor) && !empty($secondActor) && !empty($thirdActor) && !empty($director) && !empty($company) && !empty($country) && !empty($releaseYear) && !empty($durationHours) && !empty($durationMinutes)) {
                if (MovieManager::exist($title) || $title == $movie->Title) {
                    if ($firstActor != $secondActor && $firstActor != $thirdActor && $secondActor != $thirdActor) {
                        if (MovieManager::update($movieId, $title, $description, $releaseYear, timeToMinutes($durationHours, $durationMinutes), $_FILES['poster'], $links, CodeManager::getDirectorByName($director)->Id, CodeManager::getCompanyByName($company)->Id, CodeManager::getCountryByName($country)->Iso2, CodeManager::getGenderByLabel($gender)->Code, SessionManager::getLoggedUser()->Id)) {
                            if (CodeManager::deleteActorsFromMovie($movieId) && CodeManager::setActorsToMovie($actorsArray, $title)) {
                                if ($_FILES['medias']['name'][0] != "") {
                                    if (!CodeManager::setMediasToMovie($_FILES['medias'], $title)) {
                                        showError("L'ajout des médias a échoué.");
                                    }
                                }
                                header('Refresh: 0');
                                showSuccess("Le film a été modifié avec succès.");
                            } else {
                                showError("L'ajout des acteurs a échoué.");
                            }
                        } else {
                            showError("La modification du film a échoué.");
                        }
                    } else {
                        showError("Les trois acteurs doivent être différents.");
                    }
                } else {
                    showError("Vous donnez un nom de film qui est déjà utilisé.");
                }
            } else {
                showError("Veuillez remplir tous les champs.");
            }
        }

        // Pour supprimer le film
        if (isset($deleteButton)) {
            if (MovieManager::delete($movieId)) {
                header('Location: myMovies.php');
            }
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="gender">Genre</label>
                <select class="form-control" id="gender" name="gender" value="<?= $movie->Gender->Label ?>">
                    <?php
                    foreach ($genders as $gender) {
                    ?>
                        <option <?php if ($gender->Label == $movie->Gender->Label) echo 'selected' ?>><?= $gender->Label ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $movie->Title ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $movie->Description ?></textarea>
            </div>
            <label for="firstActor">Acteurs principaux</label>
            <div class="form-group row px-3">
                <select class="form-control col mr-3" id="firstActor" name="firstActor">
                    <?php
                    foreach ($actors as $actor) {
                    ?>
                        <option <?php if ($actor->Actor == $movie->Actors[0]->Actor) echo 'selected' ?>><?= $actor->Actor ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select class="form-control col mr-3" id="secondActor" name="secondActor">
                    <?php
                    foreach ($actors as $actor) {
                    ?>
                        <option <?php if ($actor->Actor == $movie->Actors[1]->Actor) echo 'selected' ?>><?= $actor->Actor ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select class="form-control col" id="thirdActor" name="thirdActor">
                    <?php
                    foreach ($actors as $actor) {
                    ?>
                        <option <?php if ($actor->Actor == $movie->Actors[2]->Actor) echo 'selected' ?>><?= $actor->Actor ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="director">Réalisateur</label>
                <select class="form-control" id="director" name="director">
                    <?php
                    foreach ($directors as $director) {
                    ?>
                        <option <?php if ($director->Director == $movie->Director->Director) echo 'selected' ?>><?= $director->Director ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="w-100">
                <label for="company" class="w-50">Société de production</label>
                <label for="country">Pays d'origine</label>
            </div>
            <div class="form-group row px-3">
                <select class="form-control col mr-3" id="company" name="company">
                    <?php
                    foreach ($companies as $company) {
                    ?>
                        <option <?php if ($company->Company == $movie->Company->Company) echo 'selected' ?>><?= $company->Company ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select class="form-control col" id="country" name="country">
                    <?php
                    foreach ($countries as $country) {
                    ?>
                        <option <?php if ($country->Country == $movie->Country->Country) echo 'selected' ?>><?= $country->Country ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="w-100">
                <label for="releaseYear" class="w-50">Année de sortie</label>
                <label for="durationHours">Durée du film</label>
            </div>
            <div class="form-group row px-3">
                <input type="number" value="<?= $movie->ReleaseYear ?>" class="form-control col mr-3" id="releaseYear" name="releaseYear">
                <div class="col row">
                    <input type="number" class="form-control col mr-3" id="durationHours" name="durationHours" value="<?= timeDBToHours($movie->Duration) ?>"> heures et
                    <input type="number" class="form-control col mx-3" id="durationMinutes" name="durationMinutes" value="<?= timeDBToMinutes($movie->Duration) ?>"> minutes
                </div>
            </div>
            <div class="form-group">
                <label for="links">Liens</label>
                <textarea class="form-control" id="links" name="links" rows="3"><?= $movie->Links ?></textarea>
            </div>
            <div class="w-100">
                <label for="poster" class="w-50">Affiche du film</label>
                <label for="medias">Médias à ajouter</label>
            </div>
            <div class="form-group row">
                <div class="col-6"><img src="<?= $movie->Poster ?>" alt="poster" width="250" />
                    <input type="file" class="form-control-file col mt-1 media" id="poster" name="poster" accept="image/*"></div>
                <div class="col-6">
                    <?php
                    foreach ($movie->Medias as $media) {
                        if (strpos($media->Media, 'image')) {
                            echo '<div class="row my-2"><img src="' . $media->Media . '" width="250" class="media"></br>';
                        } else if (strpos($media->Media, 'video')) {
                            echo '<div class="row my-2"><video width="250" controls><source src="' . $media->Media . '" class="media"></video>';
                        } else if (strpos($media->Media, 'audio')) {
                            echo '<div class="row my-2"><audio controls><source src="' . $media->Media . '" class="media"></audio>';
                        }
                        echo '<a href="deleteMedias.php?media=' . $media->Id . '" class="btn btn-danger ml-1 h-50">Supprimer</a></div>';
                    }
                    ?>
                    <input type="file" class="form-control-file col mt-1" id="medias" name="medias[]" multiple accept="image/*, video/*, audio/*">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="hide">
                <?php
                $movie = MovieManager::getById($movieId);
                if ($movie->Hidden != 1) { ?>
                    Cacher le film
                <?php } else { ?>
                    Montrer le film
                <?php } ?>
            </button>
            <button type="submit" class="btn btn-primary" name="update">Modifier le film</button>
            <button type="submit" class="btn btn-danger" name="delete">Supprimer le film</button>
        </form>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>