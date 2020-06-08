<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : index.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Page d'accueil du site
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

if (isset($_GET['nickname']) && isset($_GET['token'])) {
    $nickname = $_GET['nickname'];
    $token = $_GET['token'];
    UserManager::confirmAccount($nickname, $token);
}

header('Location: login.php');
?>