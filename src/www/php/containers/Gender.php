<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Gender.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Gender
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Gender
  */
 class Gender {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $code L'identifiant numérique du genre
     * @param string $label Le nom du genre
     */
    function __construct($code, $label)
    {
        $this->Code = $code;
        $this->Label = $label;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique du genre
     *
     * @var int
     */
    public $Code;

    /**
     * Le nom du genre
     *
     * @var string
     */
    public $Label;
 }
 ?>