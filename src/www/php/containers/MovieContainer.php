<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : MovieContainer.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du container Movie
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Movie
  */
 class MovieContainer {

    /**
     * @brief Constructeur de la classe
     *
     * @param string $title Le titre du film
     * @param string $description La description du film (résumé)
     * @param int $releaseYear L'année de sortie du film
     * @param Datetime $duration La durée du film
     * @param string $poster L'affiche du film (en base64)
     * @param int $directors_id L'identifiant numérique du réalisateur du film
     * @param int $companies_id L'identifiant numérique de la société de production du film
     * @param int $countries_id L'identifiant numérique du pays d'origine du film
     * @param int $genders_id L'identifiant numérique du genre du film
     * @param int $users_id L'identifiant numérique de l'utilisateur qui a créé le film
     */
    function __construct($title, $description, $releaseYear, $duration, $poster, $directors_id, $companies_id, $countries_id, $genders_id, $users_id)
    {
        
    }

    function __clone()
    {
    }

    /**
     * Le titre du film
     *
     * @var string
     */
    public $Title;

    /**
     * La description du film (résumé)
     *
     * @var string
     */
    public $Description;

    /**
     * L'année de sortie du film
     *
     * @var string
     */
    public $ReleaseYear;

    /**
     * La durée du film
     *
     * @var string
     */
    public $Duration;

    /**
     * L'affiche du film (en base64)
     *
     * @var string
     */
    public $Poster;

    /**
     * L'identifiant numérique du réalisateur du film
     *
     * @var string
     */
    public $Directors_id;

    /**
     * L'identifiant numérique de la société de production du film
     *
     * @var string
     */
    public $Companies_id;

    /**
     * L'identifiant numérique du pays d'origine du film
     *
     * @var int
     */
    public $Countries_id;

    /**
     * L'identifiant numérique de l'utilisateur qui a créé le film
     *
     * @var int
     */
    public $Genders_id;
 }
 ?>