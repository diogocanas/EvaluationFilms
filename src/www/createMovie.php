<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : createMovie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Page de détail du film
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged()) {
    header('Location: index.php');
}

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
            if ((!isset($_FILES['poster']) || !is_uploaded_file($_FILES['poster']['tmp_name']))) {
                showError('Vous devez choisir une affiche.');
                exit;
            }
            if (!empty($gender) && !empty($title) && !empty($description) && !empty($firstActor) && !empty($secondActor) && !empty($thirdActor) && !empty($director) && !empty($company) && !empty($country) && !empty($releaseYear) && !empty($durationHours) && !empty($durationMinutes)) {
                if (MovieManager::exist($title)) {
                    if ($firstActor != $secondActor && $firstActor != $thirdActor && $secondActor != $thirdActor) {
                        if (MovieManager::create($title, $description, $releaseYear, timeToMinutes($durationHours, $durationMinutes), $_FILES['poster'], 0, $links, CodeManager::getDirectorByName($director)->Id, CodeManager::getCompanyByName($company)->Id, CodeManager::getCountryByName($country)->Iso2, CodeManager::getGenderByLabel($gender)->Code, SessionManager::getLoggedUser()->Id)) {
                            if (CodeManager::setActorsToMovie($actorsArray, $title)) {
                                if ($_FILES['medias']['name'][0] != "") {
                                    if (!CodeManager::setMediasToMovie($_FILES['medias'], $title)) {
                                        showError("L'ajout des médias a échoué.");
                                    }
                                } showSuccess("Le film a été créé avec succès.");
                            } else {
                                showError("L'ajout des acteurs a échoué.");
                            }
                        } else {
                            showError("La création du film a échoué.");
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
                        echo "<option>" . $gender->Label . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <label for="firstActor">Acteurs principaux</label>
            <div class="form-group row px-3">
                <select class="form-control col mr-3" id="firstActor" name="firstActor">
                    <?php
                    foreach ($actors as $actor) {
                        echo "<option>" . $actor->Actor . "</option>";
                    }
                    ?>
                </select>
                <select class="form-control col mr-3" id="secondActor" name="secondActor">
                    <?php
                    foreach ($actors as $actor) {
                        echo "<option>" . $actor->Actor . "</option>";
                    }
                    ?>
                </select>
                <select class="form-control col" id="thirdActor" name="thirdActor">
                    <?php
                    foreach ($actors as $actor) {
                        echo "<option>" . $actor->Actor . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="director">Réalisateur</label>
                <select class="form-control" id="director" name="director">
                    <?php
                    foreach ($directors as $director) {
                        echo "<option>" . $director->Director . "</option>";
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
                        echo "<option>" . $company->Company . "</option>";
                    }
                    ?>
                </select>
                <select class="form-control col" id="country" name="country">
                    <?php
                    foreach ($countries as $country) {
                        echo "<option>" . $country->Country . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="w-100">
                <label for="releaseYear" class="w-50">Année de sortie</label>
                <label for="durationHours">Durée du film</label>
            </div>
            <div class="form-group row px-3">
                <input type="number" value="2020" class="form-control col mr-3" id="releaseYear" name="releaseYear">
                <div class="col row">
                    <input type="number" class="form-control col mr-3" id="durationHours" name="durationHours"> heures et
                    <input type="number" class="form-control col mx-3" id="durationMinutes" name="durationMinutes"> minutes
                </div>
            </div>
            <div class="form-group">
                <label for="links">Liens</label>
                <textarea class="form-control" id="links" name="links" rows="3"></textarea>
            </div>
            <div class="w-100">
                <label for="poster" class="w-50">Affiche du film</label>
                <label for="medias">Médias à ajouter</label>
            </div>
            <div class="form-group row">
                <input type="file" class="form-control-file col" id="poster" name="poster" accept="image/*">
                <input type="file" class="form-control-file col" id="medias" name="medias[]" multiple accept="image/*, video/*, audio/*"><span id="preview"></span>
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
</body>

</html>