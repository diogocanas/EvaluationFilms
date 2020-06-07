<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : createMovie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Page de création de film
 * Version        : 1.0
 */

 /**
  * @brief Cette page permet à l'utilisateur de créer une référence de film.
  */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged()) {
    header('Location: login.php');
}

$genders = CodeManager::getAllGenders();
$actors = CodeManager::getAllActors();
$directors = CodeManager::getAllDirectors();
$companies = CodeManager::getAllCompanies();
$countries = CodeManager::getAllCountries();

$genderForm = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$firstActor = filter_input(INPUT_POST, 'firstActor', FILTER_SANITIZE_STRING);
$secondActor = filter_input(INPUT_POST, 'secondActor', FILTER_SANITIZE_STRING);
$thirdActor = filter_input(INPUT_POST, 'thirdActor', FILTER_SANITIZE_STRING);
$directorForm = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_STRING);
$companyForm = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
$countryForm = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
$releaseYear = filter_input(INPUT_POST, 'releaseYear', FILTER_VALIDATE_INT);
$duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
$links = filter_input(INPUT_POST, 'links', FILTER_SANITIZE_STRING);
$createButton = filter_input(INPUT_POST, 'create');

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

    <title>Page de création de films</title>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
    <div class="container overflow-hidden p-0">
        <?php
        if (isset($createButton)) {
            if (!empty($genderForm) && !empty($title) && !empty($description) && !empty($firstActor) && !empty($secondActor) && !empty($thirdActor) && !empty($directorForm) && !empty($companyForm) && !empty($countryForm) && !empty($releaseYear) && !empty($duration)) {
                if (MovieManager::exist($title)) {
                    if ($firstActor != $secondActor && $firstActor != $thirdActor && $secondActor != $thirdActor) {
                        if ((isset($_FILES['poster']) && is_uploaded_file($_FILES['poster']['tmp_name']))) {
                            if ($releaseYear >= 0) {
                                if ($duration >= 0) {
                                    if (MovieManager::create($title, $description, $releaseYear, $duration, $_FILES['poster'], 0, $links, CodeManager::getDirectorByName($directorForm)->Id, CodeManager::getCompanyByName($companyForm)->Id, CodeManager::getCountryByName($countryForm)->Iso2, CodeManager::getGenderByLabel($genderForm)->Code, SessionManager::getLoggedUser()->Id)) {
                                        if (MovieManager::setActorsToMovie($actorsArray, $title)) {
                                            if ($_FILES['medias']['name'][0] != "") {
                                                if (!MovieManager::setMediasToMovie($_FILES['medias'], $title)) {
                                                    showError("L'ajout des médias a échoué.");
                                                }
                                            }
                                            showSuccess("Le film a été créé avec succès.");
                                        } else {
                                            showError("L'ajout des acteurs a échoué.");
                                        }
                                    } else {
                                        showError("La création du film a échoué.");
                                    }
                                } else {
                                    showError("La durée du film doit être supérieure à 0.");
                                }
                            } else {
                                showError("L'année de sortie doit être supérieure ou égale à 0");
                            }
                        } else {
                            showError("Vous devez choisir une affiche.");
                        }
                    } else {
                        showError("Les trois acteurs doivent être différents.");
                    }
                } else {
                    showError("La référence que vous tentez de créer existe déjà.");
                }
            } else {
                showError("Veuillez remplir tous les champs.");
            }
        }
        ?>
        <form method="POST" action="createMovie.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="gender">Genre</label>
                <select class="form-control" id="gender" name="gender">
                    <?php
                    foreach ($genders as $gender) {
                    ?>
                        <option <?php if ($gender->Label == $genderForm) echo 'selected' ?>><?= $gender->Label ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $description ?></textarea>
            </div>
            <label for="firstActor">Acteurs principaux</label>
            <div class="form-group row px-3">
                <select class="form-control col mr-3" id="firstActor" name="firstActor">
                    <?php
                    foreach ($actors as $actor) {
                    ?>
                        <option <?php if ($actor->Actor == $firstActor) echo 'selected' ?>><?= $actor->Actor ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select class="form-control col mr-3" id="secondActor" name="secondActor">
                    <?php
                    foreach ($actors as $actor) {
                    ?>
                        <option <?php if ($actor->Actor == $secondActor) echo 'selected' ?>><?= $actor->Actor ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select class="form-control col" id="thirdActor" name="thirdActor">
                    <?php
                    foreach ($actors as $actor) {
                    ?>
                        <option <?php if ($actor->Actor == $thirdActor) echo 'selected' ?>><?= $actor->Actor ?></option>
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
                        <option <?php if ($director->Director == $directorForm) echo 'selected' ?>><?= $director->Director ?></option>
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
                        <option <?php if ($company->Company == $companyForm) echo 'selected' ?>><?= $company->Company ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select class="form-control col" id="country" name="country">
                    <?php
                    foreach ($countries as $country) {
                    ?>
                        <option <?php if ($country->Country == $countryForm) ?>><?= $country->Country ?></option>
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
                <input type="number" value="<?php if ($releaseYear == "") echo '2020';
                                            else echo $releaseYear ?>" class="form-control col mr-3" id="releaseYear" name="releaseYear" min="0">
                <div class="col row">
                    <input type="number" class="form-control col" id="duration" name="duration" value="<?= $duration ?>" min="0">
                </div>
            </div>
            <div class="form-group">
                <label for="links">Liens</label>
                <textarea class="form-control" id="links" name="links" rows="3"><?= $links ?></textarea>
            </div>
            <div class="w-100">
                <label for="poster" class="w-50">Affiche du film</label>
                <label for="medias">Médias à ajouter</label>
            </div>
            <div class="form-group row">
                <div class="col"><div id="divPoster"></div>
                <input type="file" class="form-control-file" id="poster" name="poster" accept="image/*"></div>
                <div class="col"><div id="divMedias"></div>
                <input type="file" class="form-control-file col" id="medias" name="medias[]" multiple accept="image/*, video/*, audio/*"></div>
            </div>
            <button type="submit" class="btn btn-primary" name="create">Créer le film</button>
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
            $('#divPoster').empty();
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var img = $(document.createElement('img'));
                img.attr('src', reader.result);
                img.attr('width', 250);
                img.appendTo('#divPoster');
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