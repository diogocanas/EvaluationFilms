<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Rating.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Rating
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Rating
  */
 class Rating {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique de la note
     * @param string $score La note donnée par l'utilisateur
     * @param int $usersId L'identifiant numérique de l'utilisateur
     * @param int $moviesId L'identifiant numérique du film
     */
    function __construct($id, $score, $usersId, $moviesId)
    {
        $this->Id = $id;
        $this->Score = $score;
        $this->UsersId = $usersId;
        $this->MoviesId = $moviesId;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique de la note
     *
     * @var int
     */
    public $Id;

    /**
     * La note donnée par l'utilisateur
     *
     * @var string
     */
    public $Score;

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
 }
 ?>