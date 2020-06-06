<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : profile.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 02 juin 2020
 * Description    : Page de profil
 * Version        : 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged()) {
    header('Location: index.php');
}

$nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$updateButton = filter_input(INPUT_POST, 'update');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Page de profil</title>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
    <div class="container">
        <?php
        if ((!isset($_FILES['avatar']) || !is_uploaded_file($_FILES['avatar']['tmp_name']))) {
            $avatar = null;
        } else {
            $avatar = $_FILES['avatar']['tmp_name'];
        }
        if (isset($updateButton)) {
            if (!empty($nickname)) {
                if (UserManager::update($nickname, $name, $firstName, $avatar, SessionManager::getLoggedUser()->Email)) {
                    showSuccess("Le profil a été modifié correctement.");
                } else {
                    showError("Le profil n'a pas été modifié.");
                }
            } else {
                showError("Le surnom est obligatoire.");
            }
        }
        ?>
        <form method="POST" action="profile.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" value="<?= SessionManager::getLoggedUser()->Nickname ?>" autofocus required>
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= SessionManager::getLoggedUser()->Name ?>">
            </div>
            <div class="form-group">
                <label for="firstName">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?= SessionManager::getLoggedUser()->FirstName ?>">
            </div>
            <div class="form-group">
                <label>Adresse mail</label>
                <p><?= SessionManager::getLoggedUser()->Email ?></p>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label><br />
                <img src="<?= SessionManager::getLoggedUser()->Avatar ?>" width="250">
                <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" name="update">Modifier</button>
        </form>
    </div>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php';
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        $('input[type=file]').change (function(){
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function () {
                $('img').attr('src', reader.result);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>