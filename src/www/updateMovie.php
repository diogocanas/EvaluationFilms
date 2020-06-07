<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : updateMovie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 03 juin 2020
 * Description    : Page de modification de film
 * Version        : 1.0
 */

 /**
  * @brief Cette page sert à modifier un film. Elle est uniquement accessible depuis la page myMovies
  */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged()) {
    header('Location: login.php');
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
$duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
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
            if (!empty($gender) && !empty($title) && !empty($description) && !empty($firstActor) && !empty($secondActor) && !empty($thirdActor) && !empty($director) && !empty($company) && !empty($country) && !empty($releaseYear) && !empty($duration)) {
                if (MovieManager::exist($title) || $title == $movie->Title) {
                    if ($firstActor != $secondActor && $firstActor != $thirdActor && $secondActor != $thirdActor) {
                        if ($releaseYear >= 0) {
                            if ($duration >= 0) {
                                if (MovieManager::update($movieId, $title, $description, $releaseYear, $duration, $_FILES['poster'], $links, CodeManager::getDirectorByName($director)->Id, CodeManager::getCompanyByName($company)->Id, CodeManager::getCountryByName($country)->Iso2, CodeManager::getGenderByLabel($gender)->Code, SessionManager::getLoggedUser()->Id)) {
                                    if (CodeManager::deleteActorsFromMovie($movieId) && MovieManager::setActorsToMovie($actorsArray, $title)) {
                                        if ($_FILES['medias']['name'][0] != "") {
                                            if (!MovieManager::setMediasToMovie($_FILES['medias'], $title)) {
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
                                showError("La durée du film doit être supérieure à 0.");
                            }
                        } else {
                            showError("L'année de sortie doit être supérieure ou égale à 0.");
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
                <input type="text" class="form-control" id="title" name="title" value="<?php if ($title == "") echo $movie->Title;
                                                                                        else echo $title ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php if ($description == "") echo $movie->Description;
                                                                                            else echo $description ?></textarea>
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
                <label for="duration">Durée du film (en minutes)</label>
            </div>
            <div class="form-group row px-3">
                <input type="number" value="<?php if ($releaseYear == "") echo $movie->ReleaseYear;
                                            else echo $releaseYear ?>" class="form-control col mr-3" id="releaseYear" name="releaseYear" min="0">
                <div class="col row">
                    <input type="number" class="form-control col" id="duration" name="duration" value="<?php if ($duration == "") echo $movie->Duration; else echo $duration ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="links">Liens</label>
                <textarea class="form-control" id="links" name="links" rows="3"><?php if ($links == "") echo $movie->Links;
                                                                                else echo $links ?></textarea>
            </div>
            <div class="w-100">
                <label for="poster" class="w-50">Affiche du film</label>
                <label for="medias">Médias à ajouter</label>
            </div>
            <div class="form-group row">
                <div class="col-6"><img src="<?= $movie->Poster ?>" alt="poster" width="250" id="imgPoster" />
                    <input type="file" class="form-control-file col mt-1" id="poster" name="poster" accept="image/*"></div>
                <div class="col-6">
                    <?php
                    foreach ($movie->Medias as $media) {
                        if (strpos($media->Media, 'image')) {
                            echo '<div class="row my-2"><img src="' . $media->Media . '" width="250" class="media" id="imgMedia"></br>';
                        } else if (strpos($media->Media, 'video')) {
                            echo '<div class="row my-2"><video width="250" controls><source src="' . $media->Media . '" class="media" id="vidImg"></video>';
                        } else if (strpos($media->Media, 'audio')) {
                            echo '<div class="row my-2"><audio controls><source src="' . $media->Media . '" class="media" id="audImg"></audio>';
                        }
                        echo '<a href="deleteMedias.php?mediaId=' . $media->Id . '&movieId=' . $movieId . '" class="btn btn-danger ml-1 h-50">Supprimer</a></div>';
                    }
                    ?>
                    <div id="divMedias"></div>
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
    <script>
        $('#poster').change(function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function() {
                $('#imgPoster').attr('src', reader.result);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        $('#medias').change(function() {
            $('#divMedias').empty();
            var files = $(this)[0].files;

            $(files).each(function() {
                var reader = new FileReader();
                if (this.type.includes("image")) {
                    reader.addEventListener("load", function() {
                        var img = $(document.createElement('img'));
                        img.attr('src', reader.result);
                        img.attr('width', 250);
                        img.appendTo('#divMedias');
                    }, false);
                } else if (this.type.includes("video")) {
                    reader.addEventListener("load", function() {
                        var vid = $(document.createElement('video'));
                        vid.attr('width', 250);
                        vid.attr('controls', true);
                        vid.attr('src', reader.result);
                        vid.appendTo('#divMedias');
                    }, false);
                } else if (this.type.includes("audio")) {
                    reader.addEventListener("load", function() {
                        var aud = $(document.createElement('audio'));
                        aud.attr('controls', true);
                        aud.attr('src', reader.result);
                        aud.appendTo('#divMedias');
                    }, false);
                }
                if (this) {
                    reader.readAsDataURL(this);
                }
            });
        });
    </script>
</body>

</html>