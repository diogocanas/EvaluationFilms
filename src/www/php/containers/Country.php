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
     * @param string $iso2 L'identifiant du pays d'origine
     * @param string $country Le nom du pays d'origine
     */
    function __construct($iso2, $country)
    {
        $this->Iso2 = $iso2;
        $this->Country = $country;
    }

    /**
     * L'identifiant du pays d'origine
     *
     * @var string
     */
    public $Iso2;

    /**
     * Le nom du pays d'origine
     *
     * @var string
     */
    public $Country;
 }
 ?>