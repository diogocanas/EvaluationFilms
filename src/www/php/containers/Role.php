<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Role.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Role
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Role
  */
 class Role {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $code L'identifiant numérique du rôle
     * @param string $label Le nom du rôle
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
     * L'identifiant numérique du rôle
     *
     * @var int
     */
    public $Code;

    /**
     * Le nom du rôle
     *
     * @var string
     */
    public $Label;
 }
 ?>