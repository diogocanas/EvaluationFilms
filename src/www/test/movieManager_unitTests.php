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

/**
 * Test de la méthode create()
 */
/*if (MovieManager::create("TH", "Film cool", 2000, 167, "oui", "https://www.php.net/manual/fr/pdo.rollback", 2, 1, 'FR', 1, 1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode update()
 */
/*if (MovieManager::update(6, "TH", "Film cool", 2004, 167, "oui", "https://www.php.net/manual/fr/pdo.rollback", 2, 1, 'US', 1, 1)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode delete()
 */
/*if (MovieManager::delete(6)) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode getAll()
 */
if (!MovieManager::getAll()) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getAll());
}

/**
 * Test de la méthode getById()
 */
/*if (!MovieManager::getById(1)) {
    echo "Don't works";
} else {
    var_dump(MovieManager::getAll());
}