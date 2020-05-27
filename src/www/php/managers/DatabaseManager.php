<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : DatabaseManager.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du manager DatabaseManager
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe manager de DatabaseManager
  */
 class DatabaseManager {
     private static $objInstance;

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
      * @brief Méthode qui retourne une instance PDO
      *
      * @return PDO $objInstance L'instance de l'objet PDO pour la connexion à la base de données
      */
      public static function getInstance() {
        if (!self::$objInstance) {
            try {
                $dsn = DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
                self::$objInstance = new PDO($dsn, DB_USER, DB_PWD, array('charset'=>'utf8'));
                self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        }
        return self::$objInstance;
    }
 }
 ?>