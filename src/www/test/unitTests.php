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
 * Test de la fonction getInstance() de la classe DatabaseManager
 */
if (DatabaseManager::getInstance() != null) {
    return true;
} else {
    return false;
}


?>