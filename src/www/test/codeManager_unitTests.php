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
session_start();

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
/*if (!CodeManager::getGenderByLabel("Action")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getGenderByLabel("Action"));
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
/*if (!CodeManager::getDirectorByName("Martin Scorsese")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getDirectorByName("Martin Scorsese"));
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
/*if (!CodeManager::getActorById(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorById(1));
}

/**
 * Test de la méthode getActorByName()
 */
/*if (!CodeManager::getActorByName("Brad Pitt")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorByName("Brad Pitt"));
}

/**
 * Test de la méthode getActorsByMovieId()
 */
/*if (!CodeManager::getActorsByMovieId(26)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorsByMovieId(26));
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
/*if (!CodeManager::getMediaById(30)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getMediaById(30));
}

/**
 * Test de la méthode getMediasByMovieId()
 */
/*if (!CodeManager::getMediasByMovieId(26)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getMediasByMovieId(26));
}

/**
 * Test de la méthode deleteMediaById()
 */
/*if (CodeManager::deleteMediaById(26)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Tests de Rating
 */
/**
 * Test de la méthode getRatingsByMovieId()
 */
/*if (!CodeManager::getRatingsByMovieId(26)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getRatingsByMovieId(26));
}

/**
 * Test de la méthode getAvgRatingByMovieId()
 */
/*if (CodeManager::getAvgRatingByMovieId(26) >= 0) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getNumberRatingsByMovieId()
 */
/*if (CodeManager::getNumberRatingsByMovieId(26) >= 0) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode alreadyRated()
 */
/*if (!CodeManager::alreadyRated(26)) {
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