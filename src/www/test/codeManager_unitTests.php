<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : codeManager_unitTests.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de tests unitaires pour la classe CodeManager
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * Tests de Role
 */

/**
 * Test de la méthode getRoleByCode()
 */
/*if (!CodeManager::getRoleByCode(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getRoleByCode(1));
}

/**
 * Tests de Gender
 */

/**
 * Test de la méthode getGenderByCode()
 */
/*if (!CodeManager::getGenderByCode(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getGenderByCode(1));
}

/**
 * Test de la méthode getGenderByLabel()
 */
/*if (!CodeManager::getGenderByLabel(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getGenderByLabel(1));
}

/**
 * Test de la méthode getAllGenders()
 */
/*if (!CodeManager::getAllGenders()) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getAllGenders());
}

/**
 * Tests de Director
 */

/**
 * Test de la méthode getDirectorById()
 */
/*if (!CodeManager::getDirectorById(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getDirectorById(1));
}

/**
 * Test de la méthode getDirectorByName()
 */
/*if (!CodeManager::getDirectorByName("Alfred Hitchcock")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getDirectorByName("Alfred Hitchcock"));
}

/**
 * Test de la méthode getAllDirectors()
 */
/*if (!CodeManager::getAllDirectors()) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getAllDirectors());
}

/**
 * Tests de Actor
 */

/**
 * Test de la méthode getActorById()
 */
/*if (!CodeManager::getActorById(2)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorById(2));
}

/**
 * Test de la méthode getActorByName()
 */
/*if (!CodeManager::getActorByName("Leonardo DiCaprio")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorByName("Leonardo DiCaprio"));
}

/**
 * Test de la méthode getActorsByMovieId()
 */
/*if (!CodeManager::getActorsByMovieId(2)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorsByMovieId(2));
}

/**
 * Test de la méthode getAllActors()
 */
/*if (!CodeManager::getAllActors()) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getAllActors());
}

/**
 * Tests de Company
 */

/**
 * Test de la méthode getCompanyById()
 */
/*if (!CodeManager::getCompanyById(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getCompanyById(1));
}

/**
 * Test de la méthode getCompanyByName()
 */
/*if (!CodeManager::getCompanyByName("Warner Bros.")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getCompanyByName("Warner Bros."));
}

/**
 * Test de la méthode getAllCompanies()
 */
/*if (!CodeManager::getAllCompanies()) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getAllCompanies());
}

/**
 * Tests de Country
 */

/**
 * Test de la méthode getCountryByIso2()
 */
/*if (!CodeManager::getCountryByIso2("FR")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getCountryByIso2("FR"));
}

/**
 * Test de la méthode getCountryByName()
 */
/*if (!CodeManager::getCountryByName("France")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getCountryByName("France"));
}

/**
 * Test de la méthode getAllCountries()
 */
/*if (!CodeManager::getAllCountries()) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getAllCountries());
}

/**
 * Tests de Media
 */
/**
 * Test de la méthode getMediaById()
 */
/*if (!CodeManager::getMediaById(2)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getMediaById(2));
}

/**
 * Test de la méthode getMediasByMovieId()
 */
/*if (!CodeManager::getMediasByMovieId(2)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getMediasByMovieId(2));
}

/**
 * Tests de Rating
 */
/**
 * Test de la méthode getAvgRatingByMovieId()
 */
/*if (CodeManager::getAvgRatingByMovieId(5) != 0) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getNumberRatingsByMovieId()
 */
/*if (CodeManager::getNumberRatingsByMovieId(5) > 0) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode addRateToMovie()
 */
/*if (CodeManager::addRateToMovie(5, 10, "oui")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode alreadyRated()
 */
/*if (!CodeManager::alreadyRated(5)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Tests de Status
 */

/**
 * Test de la méthode getStatusByCode()
 */
/*if (!CodeManager::getStatusByCode(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getStatusByCode(1));
}

/**
 * Tests de la table PARTICIPATE
 */
if (CodeManager::setActorsToMovie(array("Robert De Niro", "Brad Pitt", "Al Pacino"), "TPI")) {
    echo "Works";
} else {
    echo "Don't works";
}