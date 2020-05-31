<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : databaseManager_unitTests.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de tests unitaires pour la classe DatabaseManager
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * Test de la méthode getInstance()
 */
/*if (DatabaseManager::getInstance() != null) {
    echo "Works";
} else {
    echo "Don't works";
}