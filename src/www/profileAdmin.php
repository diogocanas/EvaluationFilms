<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : profileAdmin.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 03 juin 2020
 * Description    : Page de profil
 * Version        : 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (SessionManager::getLoggedUser()->Role->Code != 2) {
    header('Location: index.php');
}

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
} else {
    header('Location: userManagement.php');
}

$user = UserManager::getById($userId);

$blockButton = filter_input(INPUT_POST, 'block');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Page de profil pour administrateur</title>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
    <div class="container">
        <?php
        if (isset($blockButton)) {
            if (UserManager::block($user)) {
                header('Refresh: 0');
            }
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <p><?= $user->Nickname ?></p>
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <p><?= $user->Name ?></p>
            </div>
            <div class="form-group">
                <label for="firstName">Prénom</label>
                <p><?= $user->FirstName ?></p>
            </div>
            <div class="form-group">
                <label>Adresse mail</label>
                <p><?= $user->Email ?></p>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label><br />
                <img src="<?= $user->Avatar ?>" width="250">
            </div>
            <button type="submit" class="btn btn-primary" name="block">
                <?php if ($user->Status->Code != 3) {
                    echo "Bloquer";
                } else {
                    echo "Débloquer";
                }
                ?>
            </button>
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
</body>

</html>