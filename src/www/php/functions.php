<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : functions.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier de fonctions
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * Fonction qui affiche un message de succès
 *
 * @param string $message Le message de succès
 */
function showSuccess($message)
{
?>
    <div class="alert alert-success mt-2" role="alert">
        <?= $message ?>
    </div>
<?php
}

/**
 * Fonction qui affiche un message d'avertissement
 *
 * @param string $message Le message d'avertissement
 */
function showWarning($message)
{
?>
    <div class="alert alert-warning mt-2" role="alert">
        <?= $message ?>
    </div>
<?php
}

/**
 * Fonction qui affiche un message d'erreur
 *
 * @param string $message Le message de l'erreur
 */
function showError($message)
{
?>
    <div class="alert alert-danger mt-2" role="alert">
        <?= $message ?>
    </div>
<?php
}

/**
 * @brief Fonction qui transforme un format "1h30" en "90m"
 *
 * @param int $hours Le nombre d'heures
 * @param int $minutes Le nombre de minutes
 * @return int Le nombre de minutes totales
 */
function timeToMinutes($hours, $minutes)
{
    return $hours * 60 + $minutes;
}

/**
 * @brief Fonction qui retourne le nombre d'heures entières dans x minutes
 *
 * @param int $minutes Le nombre de minutes
 * @return int Le nombre d'heures entières
 */
function timeDBToHours($minutes)
{
    return ($minutes - ($minutes % 60)) / 60;
}

/**
 * @brief Fonction qui retourne le nombre de minutes qu'il reste après avoir soustrait les heures entières
 *
 * @param int $minutes Le nombre de minutes
 * @return int Le nombre de minutes qu'il reste après avoir soustrait les heures entières
 */
function timeDBToMinutes($minutes)
{
    return $minutes - timeDBToHours($minutes) * 60;
}

/**
 * @brief Fonction qui sépare les liens afin de les afficher
 *
 * @param string $links Les liens en une chaîne de caractères
 * @return string[] $linksArray Les liens séparés dans un tableau de string
 */
function getLinks($links)
{
    $linksArray = explode("\n", $links);
    return $linksArray;
}
?>