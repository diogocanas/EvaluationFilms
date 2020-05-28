<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : inc.all.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier où se trouvent tout les include de fichiers
 * Version        : 1.0
 */

 // Fichier de fonctions
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/functions.php';

 // Containers
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/User.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Movie.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Role.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Gender.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Director.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Actor.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Company.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Country.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Rating.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Media.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/containers/Status.php';

 // Managers
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/managers/DatabaseManager.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/managers/SessionManager.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/managers/UserManager.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/managers/MovieManager.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . 'php/managers/CodeManager.php';

 // Fichiers de configuration
 require_once $_SERVER['DOCUMENT_ROOT'] . 'config/conparam.php';
?>