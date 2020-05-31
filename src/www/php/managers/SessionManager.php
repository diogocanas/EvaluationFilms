<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : SessionManager.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du manager Session
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe manager de Session
  */
 class SessionManager {

     /**
     * @brief Le constructeur de la classe (privé afin que l'on ne puisse pas créer d'instances)
     */
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    /**
     * @brief Fonction qui modifie la valeur de la variable de session 'isLogged'
     *
     * @param bool $isLogged Vrai si l'utilisateur est connecté, faux sinon
     */
    public static function setIsLogged($isLogged)
    {
        $_SESSION['isLogged'] = $isLogged;
    }

    /**
     * @brief Fonction qui retourne la valeur de la variable de session 'isLogged'
     *
     * @return bool $_SESSION['isLogged'] La variable de session
     */
    public static function getIsLogged()
    {
        if (!isset($_SESSION['isLogged'])) {
            $_SESSION['isLogged'] = false;
        }
        return $_SESSION['isLogged'];
    }

    /**
     * @brief Fonction qui modifie la valeur de la variable de session 'loggedUser' 
     *
     * @param User $value Instance de la classe User
     */
    public static function setLoggedUser($user)
    {
        $_SESSION['loggedUser'] = $user;
    }

    /**
     * @brief Fonction qui retourne la valeur de la variable de session 'loggedUser'
     *
     * @return User $_SESSION['loggedUser'] La variable de session
     */
    public static function getLoggedUser()
    {
        if (!isset($_SESSION['loggedUser'])) {
            $_SESSION['loggedUser'] = null;
        }
        return $_SESSION['loggedUser'];
    }
 }
