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
     * @param int $usersId L'identifiant numérique de l'utilisateur
     * @param int $moviesId L'identifiant numérique du film
     * @param string $score La note donnée par l'utilisateur
     * @param string $remark Le commentaire de la note
     */
    function __construct($usersId, $moviesId, $score, $remark)
    {
        $this->UsersId = $usersId;
        $this->MoviesId = $moviesId;
        $this->Score = $score;
        $this->Remark = $remark;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique de l'utilisateur
     *
     * @var int
     */
    public $UsersId;

    /**
     * L'identifiant numérique du film
     *
     * @var int
     */
    public $MoviesId;

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