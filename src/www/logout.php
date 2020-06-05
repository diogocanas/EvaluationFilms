<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : logout.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de déconnexion
 * Version        : 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();
SessionManager::setIsLogged(false);
SessionManager::setLoggedUser(null);
header('Location: index.php');
?>