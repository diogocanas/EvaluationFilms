<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : mailManager_unitTests.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de tests unitaires pour la classe MailManager
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * Test de la méthode sendConfirmAccount()
 */
/*if (MailManager::sendConfirmAccount("diogo.cnslm@eduge.ch")) {
    echo "Works";
} else {
    echo "Don't works";
}

/**
 * Test de la méthode sendRatingMail()
 */
/*if (MailManager::sendRatingMail(5, 10)) {
    echo "Works";
} else {
    echo "Don't works";
}