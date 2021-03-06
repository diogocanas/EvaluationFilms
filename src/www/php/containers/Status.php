<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Status.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Status
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Status
  */
 class Status {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $code L'identifiant numérique du statut
     * @param string $label Le nom du statut
     */
    function __construct($code, $label)
    {
        $this->Code = $code;
        $this->Label = $label;
    }

    /**
     * L'identifiant numérique du statut
     *
     * @var int
     */
    public $Code;

    /**
     * Le nom du statut
     *
     * @var string
     */
    public $Label;
 }
 ?>