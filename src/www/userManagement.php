<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : userManagement.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 03 juin 2020
 * Description    : Page de gestion des utilisateurs
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (!SessionManager::getIsLogged() && SessionManager::getLoggedUser()->Role->Code != 2) {
    header('Location: index.php');
}

$users = UserManager::getAll();
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nickname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Statut</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    if ($user->Status->Code != 1) {
                        echo '<tr>';
                        echo '<td>' . $user->Nickname . '</td>';
                        echo '<td>' . $user->Email . '</td>';
                        echo '<td>' . $user->Name . '</td>';
                        echo '<td>' . $user->FirstName . '</td>';
                        echo '<td><a href="profileAdmin.php?userId=' . $user->Id . '">Voir le profil</a></td>';
                    }
                }
                ?>
            </tbody>
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