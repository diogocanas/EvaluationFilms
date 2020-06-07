<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : help.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 05 juin 2020
 * Description    : Page d'aide du site (manuel utilisateur)
 * Version        : 1.0
 */

 /**
  * @brief Cette page sert à aider l'utilisateur s'il ne sait pas comment utiliser le site.
  */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Page d'aide</title>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
    <div class="container">
        <h1>Manuel utilisateur</h1>
        <div class="list-group mb-5">
            <a href="#filter" class="list-group-item list-group-item-action">Filtres</a>
            <a href="#loginRegister" class="list-group-item list-group-item-action">Connexion / Inscription</a>
            <a href="#rating" class="list-group-item list-group-item-action">Notation d'un film</a>
            <a href="#createMovie" class="list-group-item list-group-item-action">Création d'un film</a>
            <a href="#updateMovie" class="list-group-item list-group-item-action">Modification d'un film</a>
            <a href="#profile" class="list-group-item list-group-item-action">Page de profil</a>
            <a href="#userManagement" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
        </div>
        <h2 id="filter">Filtres</h2>
        <p>
            Un formulaire est disponible en haut de <a href="index.php" target="_blank">la page d'accueil</a> et de <a href="allMovies.php" target="_blank">la page de films</a> afin de pouvoir filtrer les films. Lorsque l'on applique un filtre, il est appliqué sur tous les films du site et pas seulement ceux affichés (pour la page d'accueil). Il est également possible d'appliquer plusieurs filtres en même temps, un film sera affiché s'il rempli ne serait ce qu'une seule condition du filtre.
        </p>
        <p>Il est possible de filtrer les films par :
            <ul>
                <li>Mots-clés</li>
                <li>Genre</li>
                <li>Année de sortie</li>
                <li>Pays</li>
                <li>Durée</li>
            </ul>
        </p>
        <h2 id="loginRegister">Connexion / Inscription</h2>
        <p>
            Pour se connecter, il faut se rendre sur <a href="login.php" target="_blank">la page de connexion</a> et remplir le formulaire. Si l'utilisateur n'a pas encore de compte, il doit cliquer sur le petit lien en dessous du formulaire qui le redirigera vers <a href="register.php" target="_blank">la page d'inscription</a>.
            </br>
            Afin de s'inscrire, il faut utiliser un nickname unique et une adresse mail valide. Un mail sera envoyé à l'utilisateur afin de validé son compte. Sans cette validation, l'utilisateur ne pourra pas se connecter.
        </p>
        <h2 id="rating">Notation d'un film</h2>
        <p>
            Lorsque l'on clique sur un film dans <a href="index.php" target="_blank">la page d'accueil</a> ou <a href="allMovies.php" target="_blank">la page de films</a>, on se retrouve sur la page de détails de film.
            </br>
            Sur cette page, l'utilisateur connecté peut noter le film. En notant, il peut également laisser un commentaire. Dès que l'utilisateur valide le formulaire, la note moyenne est calculée et le commentaire est affiché correctement. Un utilisateur ne peut pas noter deux fois le même film. L'utilisateur qui a créé le film est notifié d'un mail pour l'informer que son film a été noté.
        </p>
        <h2 id="createMovie">Création d'un film</h2>
        <p>
            Pour créer un film, il faut avoir un compte et être connecté. Dans le formulaire de <a href="createMovie.php" target="_blank">la page de création</a>, tous les champs sont obligatoires sauf les liens et les médias.
            <br />
            Le titre du film est unique, donc on ne peut pas créer deux films avec le même titre. Les 3 acteurs principaux doivent être différent et l'affiche du film est obligatoire.
        </p>
        <h2 id="updateMovie">Modification d'un film</h2>
        <p>
            Pour modifier un film, il faut passer par <a href="myMovies.php" target="_blank">la page contenant tous les films créés par l'utilisateur connecté</a>. C'est en cliquant sur un des films affiché que l'utilisateur se rend sur la page de modification.
            <br />
            Les champs obligatoires sont les mêmes que ceux de la page de création. L'utilisateur peut supprimer les médias précedemment ajouter grâce au petit bouton "Supprimer" à côté du média. Il peut cacher (ou montrer) le film afin qu'il soit visible (ou non) sur le site. Il peut également le supprimer.
        </p>
        <h2 id="profile">Page de profil</h2>
        <p>
            Sur <a href="profile.php" target="_blank">la page de profil</a>, l'utilisateur connecté peut modifier ses informations personnelles. Il peut uniquement modifier son nickname (obligatoire), son nom, son prénom et sa photo de profil.
        </p>
        <h2 id="userManagement">Gestion des utilisateurs</h2>
        <p>
            L'administrateur a accès à <a href="userManagement.php" target="_blank">la page de gestion des utilisateurs</a> afin de pouvoir en bloquer. La page présente un tableau où chaque ligne représente un utilisateur. En cliquant sur le lien "Voir le profil" (tout à droite d'une ligne), il peut voir le profil de l'utilisateur et le bloquer (ou le débloquer). L'utilisateur concerné reçoit un mail pour l'informer de son blocage.
        </p>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>