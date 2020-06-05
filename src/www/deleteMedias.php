<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : logout.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Fichier de suppression de média
 * Version        : 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();
if (isset($_GET['mediaId']) && isset($_GET['movieId'])) {
    $mediaId = $_GET['mediaId'];
    $movieId = $_GET['movieId'];
} else {
    header('Location: myMovies.php');
}

CodeManager::deleteMediaById($mediaId);
header('Location: updateMovie.php?movieId=' . $movieId);
?>