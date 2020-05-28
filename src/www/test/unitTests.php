<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : unitTests.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier de tests unitaires
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * Tests de UserManager
 */

/**
 * Test de la méthode getInstance() de la classe DatabaseManager
 */
/*if (DatabaseManager::getInstance() != null) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Tests de UserManager
 */

/**
 * Test de la méthode create() de la classe UserManager
 */
/*if (UserManager::create("johndoe7", "johndoe7@gmail.com", "Super2012", 1, 1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode update() de la classe UserManager
 */
/*if (UserManager::update("johndoe", "john", "", "", "johndoe7@gmail.com")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode login() de la classe UserManager
 */
/*if (UserManager::login("johndoe7@gmail.com", "Super2012")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode login() de la classe UserManager
 */
/*if (UserManager::login("johndoe7@gmail.com", "Super2012")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode exist() de la classe UserManager
 */
/*if (!UserManager::exist("johndoe7@gmail.com")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getAll() de la classe UserManager
 */
/*if (!UserManager::getAll()) {
    echo "Don't works";
} else {
    var_dump(UserManager::getAll());
}

/**
 * Test de la méthode getById() de la classe UserManager
 */
/*if (UserManager::getById(1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Tests de MovieManager
 */

/**
 * Test de la méthode create() de la classe MovieManager
 */
/*if (MovieManager::create("TH", "Film cool", 2000, 167, "oui", "https://www.php.net/manual/fr/pdo.rollback", 2, 1, 'FR', 1, 1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode update() de la classe MovieManager
 */
/*if (MovieManager::update(6, "TH", "Film cool", 2004, 167, "oui", "https://www.php.net/manual/fr/pdo.rollback", 2, 1, 'US', 1, 1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode delete() de la classe MovieManager
 */
/*if (MovieManager::delete(6)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getAll() de la classe MovieManager
 */
if (!MovieManager::getAll()) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getAll());
}

/**
 * Test de la méthode getById() de la classe MovieManager
 */
/*if (!MovieManager::getById(1)) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getAll());
}

/**
 * Tests de CodeManager --> Role
 */

/**
 * Test de la méthode getRoleByCode() de la classe CodeManager
 */
/*if (!CodeManager::getRoleByCode(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getRoleByCode(1));
}

/**
 * Tests de CodeManager --> Gender
 */

/**
 * Test de la méthode getGenderByCode() de la classe CodeManager
 */
/*if (!CodeManager::getGenderByCode(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getGenderByCode(1));
}

/**
 * Tests de CodeManager --> Company
 */

/**
 * Test de la méthode getCompanyByCode() de la classe CodeManager
 */
/*if (!CodeManager::getCompanyById(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getCompanyById(1));
}

/**
 * Tests de CodeManager --> Country
 */

/**
 * Test de la méthode getCountryByIso2() de la classe CodeManager
 */
/*if (!CodeManager::getCountryByIso2("FR")) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getCountryByIso2("FR"));
}

/**
 * Tests de CodeManager --> Actor
 */

/**
 * Test de la méthode getActorsByMovieId() de la classe CodeManager
 */
/*if (!CodeManager::getActorsByMovieId(2)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getActorsByMovieId(2));
}

/**
 * Tests de CodeManager --> Media
 */

/**
 * Test de la méthode getMediasByMovieId() de la classe CodeManager
 */
/*if (!CodeManager::getMediasByMovieId(2)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getMediasByMovieId(2));
}

/**
 * Tests de CodeManager --> Status
 */

/**
 * Test de la méthode getStatusByCode() de la classe CodeManager
 */
/*if (!CodeManager::getStatusByCode(1)) {
    echo "Don't works";
} else {
    var_dump(CodeManager::getStatusByCode(1));
}*/
?>