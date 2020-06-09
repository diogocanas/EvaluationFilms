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
        </div>
        <h2 id="filter">Filtres</h2>
        <p>
            Sur <a href="index.php" target="_blank">la page d'accueil</a> et <a href="allMovies.php" target="_blank">la page des films</a>, un formulaire de filtrage est disponible. Grâce à ce formulaire, l'utilisateur peut afficher des films selon certaines conditions.</br>
            Les filtres disponibles sont les suivants :
            <ul>
                <li>Mots-clés</li>
                <li>Genre</li>
                <li>Année de sortie</li>
                <li>Pays d'origine</li>
                <li>Durée du film (en minutes)</li>
            </ul>
            Pour filter les films, il faut remplir un ou plusieurs champs du formulaire et cliquer sur le bouton "Filtrer". Chaque film répondant à une des conditions sera affiché.
        </p>
        <h2 id="loginRegister">Connexion / Inscription</h2>
        <p>
            Pour se rendre sur la page d'inscription, il faut cliquer sur le lien présent en dessous du formulaire de <a href="login.php" target="_blank">la page de connexion</a>.</br>
            Afin de pouvoir créer des films, il faut avoir un compte. Pour cela, il faut se rendre sur <a href="register.php" target="_blank">la page d'inscription</a>, remplir le formulaire et cliquer sur le bouton "S'inscrire". Tout les champs sont obligatoires, le nickname et l'adresse mail doivent être unique et cette dernière valide. Les mots de passes doivent être identiques.</br>
            Une fois que l'utilisateur a créé un compte, un mail lui est envoyé à l'adresse renseignée afin de pouvoir vérifier cette dernière. Il doit cliquer sur le lien présent dans le mail avant de se connecter.
        </p>
        <p>
            Pour se connecter, il faut se rendre sur la page de connexion, remplir le formulaire puis cliquer sur le bouton "Se connecter". Pour se déconnecter, il faut cliquer sur "Déconnexion" dans la barre de navigation.
        </p>
        <h2 id="rating">Notation d'un film</h2>
        <p>
            Lorsque l'on clique sur un film dans <a href="index.php" target="_blank">la page d'accueil</a> ou <a href="allMovies.php" target="_blank">la page de films</a>, on se retrouve sur la page de détails de film.
            </br>
            Sur cette page, un formulaire est disponible afin de noter le film. Il doit remplir le champ de la note et peut laisser un commentaire (facultatif) et cliquer sur "Noter le film" pour valider la note. La note n'est pas modifiable et est unique (un utilisateur ne peut pas noter deux fois le même film).
            Le propriétaire sera notifié d'un mail à chaque fois qu'un utilisateur ajoutera une note à son film. Sur cette page, l'utilisateur peut également cliquer sur les liens sur la droite de son écran et lire les vidéos ou audios reliés au film.
        </p>
        <h2 id="createMovie">Création d'un film</h2>
        <p>
            Pour créer un film, il faut avoir un compte et être connecté. Dans le formulaire de <a href="createMovie.php" target="_blank">la page de création</a>, tous les champs sont obligatoires sauf les liens et les médias.
            Le titre du film est unique, donc on ne peut pas créer deux films avec le même titre. Les 3 acteurs principaux doivent être différent et l'affiche du film est obligatoire. Une fois rempli, le formulaire est validé en cliquant sur le bouton "Créer le film".
        </p>
        <h2 id="updateMovie">Modification d'un film</h2>
        <p>
            Pour modifier un film, il faut passer par <a href="myMovies.php" target="_blank">la page contenant tous les films créés par l'utilisateur connecté</a>. C'est en cliquant sur un des films affiché que l'utilisateur se rend sur la page de modification.
            <br />
            Les champs obligatoires sont les mêmes que ceux de la page de création. Une fois le formulaire rempli, il faut cliquer sur le bouton "Modifier le film" pour confirmer les modifications. L'utilisateur peut supprimer les médias précedemment ajouter grâce au petit bouton "Supprimer" à côté du média. Il peut cacher (ou montrer) le film afin qu'il soit visible (ou non) sur le site en cliquant sur le bouton "Cacher le film" ou "Montrer le film". Il peut également le supprimer avec le bouton "Supprimer le film".
        </p>
        <h2 id="profile">Page de profil</h2>
        <p>
            Sur <a href="profile.php" target="_blank">la page de profil</a>, l'utilisateur connecté peut modifier ses informations personnelles. Il peut uniquement modifier son nickname (obligatoire), son nom, son prénom et sa photo de profil. Il doit cliquer sur "Modifier" pour sauvegarder ses modifications.
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