<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Country.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Country
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Country
  */
 class Country {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique de la société de production
     * @param string $country Le nom de la société de production
     */
    function __construct($iso2, $country)
    {
        $this->Iso2 = $iso2;
        $this->Country = $country;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique de la société de production
     *
     * @var string
     */
    public $Iso2;

    /**
     * Le nom de la société de production
     *
     * @var string
     */
    public $Country;
 }
 ?>