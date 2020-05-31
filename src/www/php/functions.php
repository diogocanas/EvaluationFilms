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
 * Fonction qui affiche une erreur
 *
 * @param string $message Le message de l'erreur
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
 * Fonction qui affiche une erreur
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
?>