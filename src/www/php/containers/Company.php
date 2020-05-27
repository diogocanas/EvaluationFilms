<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Company.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Company
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Company
  */
 class Company {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique de la société de production
     * @param string $company Le nom de la société de production
     */
    function __construct($id, $company)
    {
        $this->Id = $id;
        $this->Company = $company;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique de la société de production
     *
     * @var int
     */
    public $Id;

    /**
     * Le nom de la société de production
     *
     * @var string
     */
    public $Company;
 }
 ?>