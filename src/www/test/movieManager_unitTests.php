<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : movieManager_unitTests.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de tests unitaires pour la classe MovieManager
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';
session_start();

/**
 * Test de la méthode create()
 * $_FILES manquant
 */
/*if (MovieManager::create("TH", "Film cool", 2000, 167, array("tmp_name" => "image"), 0, "https://www.php.net/manual/fr/pdo.rollback", 2, 1, 'FR', 1, 3)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode update()
 * $_FILES manquant
 */
/*if (MovieManager::update(26, "TH", "Film cool", 2000, 167, array("tmp_name" => "image"), "https://www.php.net/manual/fr/pdo.rollback", 2, 1, 'FR', 1, 3)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode delete()
 */
/*if (MovieManager::delete(26)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode exist()
 */
/*if (MovieManager::exist("Les Affranchis")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getAll()
 */
/*if (!MovieManager::getAll()) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getAll());
}

/**
 * Test de la méthode getVisibleMovies()
 */
/*if (!MovieManager::getVisibleMovies()) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getVisibleMovies());
}

/**
 * Test de la méthode getById()
 */
/*if (!MovieManager::getById(26)) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getById(26));
}

/**
 * Test de la méthode getByTitle()
 */
/*if (!MovieManager::getByTitle("Les Affranchis")) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getByTitle("Les Affranchis"));
}

/**
 * Test de la méthode getMoviesCreatedByUserLogged()
 */
/*if (!MovieManager::getMoviesCreatedByUserLogged()) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getMoviesCreatedByUserLogged());
}

/**
 * Test de la méthode hideMovie()
 */
/*if (MovieManager::hideMovie(new Movie(26, "", "", 2, 2, "", 0, "", "", array(new Actor(1, ""), new Actor(2, ""), new Actor(3, "")), new Director(1, ""), new Company(1, ""), new Country(1, ""), new Gender(1, ""), new User(1, "", "", "", "", "", new Role(1, ""), new Status(1, ""), "", "", "")))) {
    echo "Works"; 
} else {
    echo "Don't works";
}

/**
 * Test de la méthode filter()
 */
/*if (!MovieManager::filter("Les", "Tout", "", "", "Tout", "", "")) {
    echo "Don't works";
} else {
    var_dump(MovieManager::filter("Les", "Tout", "", "", "Tout", "", ""));
}

/**
 * Test de la méthode addRateToMovie()
 */
/*if (MovieManager::addRateToMovie(27, 8, "commentaire")) {
    echo "Works"; 
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getMostRatedMovies()
 */
/*if (!MovieManager::getMostRatedMovies()) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getMostRatedMovies());
}

/**
 * Test de la méthode setActorsToMovie()
 */
/*if (MovieManager::setActorsToMovie(array("Brad Pitt", "Leonardo DiCaprio", "Robert De Niro"), "TH")) {
    echo "Works"; 
} else {
    echo "Don't works";
}

/**
 * Test de la méthode deleteActorsFromMovie()
 */
/*if (MovieManager::setActorsToMovie(27)) {
    echo "Works"; 
} else {
    echo "Don't works";
}