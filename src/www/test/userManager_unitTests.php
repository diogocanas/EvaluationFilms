<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : userManager_unitTests.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de tests unitaires pour la classe UserManager
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * Test de la méthode create()
 */
/*if (UserManager::create("johndoe7", "johndoe7@gmail.com", "Super2012")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode update()
 */
/*if (UserManager::update("johndoe", "john", "", "", "johndoe7@gmail.com")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode confirmAccount()
 */
/*if (UserManager::confirmAccount("diogo.cnslm@eduge.ch", "04bb17d57b31c71f635a8ce73d16815b552122d558eacb169da83d3f2e506713")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode login()
 */
/*if (UserManager::login("diogo.cnslm@eduge.ch", "Super2012")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode exist()
 */
/*if (!UserManager::exist("diogo.cnslm@eduge.ch")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getAll()
 */
/*if (!UserManager::getAll()) {
    echo "Don't works";
} else {
    var_dump(UserManager::getAll());
}

/**
 * Test de la méthode getById()
 */
/*if (UserManager::getById(1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getByEmail()
 */
/*if (UserManager::getByEmail("diogoalmeida1709@gmail.com")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode block()
 */
if (UserManager::block(new User(3, "diogo", "", "", "", "", null, new Status(3, ""), "", "", ""))) {
    echo "Works";
} else {
    echo "Don't works";
}