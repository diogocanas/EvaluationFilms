<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Rating.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Rating
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Rating
  */
 class Rating {

    /**
     * @brief Constructeur de la classe
     * @param string $score La note donnée par l'utilisateur
     * @param string $remark Le commentaire de la note
     */
    function __construct($score, $remark)
    {
        $this->Score = $score;
        $this->Remark = $remark;
    }

    function __clone()
    {
    }

    /**
     * La note donnée par l'utilisateur
     *
     * @var string
     */
    public $Score;
    
    /**
     * Le commentaire de la note
     *
     * @var string
     */
    public $Remark;
 }
 ?>