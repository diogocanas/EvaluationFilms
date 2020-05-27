<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Movie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du container Movie
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Movie
  */
 class Movie {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique du film
     * @param string $title Le titre du film
     * @param string $description La description du film (résumé)
     * @param int $releaseYear L'année de sortie du film
     * @param Datetime $duration La durée du film
     * @param string $poster L'affiche du film (en base64)
     * @param int $directorsId L'identifiant numérique du réalisateur du film
     * @param int $companiesId L'identifiant numérique de la société de production du film
     * @param int $countriesId L'identifiant numérique du pays d'origine du film
     * @param int $gendersCode L'identifiant numérique du genre du film
     * @param int $usersId L'identifiant numérique de l'utilisateur qui a créé le film
     */
    function __construct($id, $title, $description, $releaseYear, $duration, $poster, $directorsId, $companiesId, $countriesId, $gendersCode, $usersId)
    {
        $this->Id = $id;
        $this->Title = $title;
        $this->Description = $description;
        $this->ReleaseYear = $releaseYear;
        $this->Duration = $duration;
        $this->Poster = $poster;
        $this->DirectorsId = $directorsId;
        $this->CompaniesId = $companiesId;
        $this->CountriesId = $countriesId;
        $this->GendersCode = $gendersCode;
        $this->UsersId = $usersId;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique du film
     *
     * @var int
     */
    public $Id;

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
     * @var int
     */
    public $ReleaseYear;

    /**
     * La durée du film
     *
     * @var Datetime
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
     * @var int
     */
    public $DirectorsId;

    /**
     * L'identifiant numérique de la société de production du film
     *
     * @var int
     */
    public $CompaniesId;

    /**
     * L'identifiant numérique du pays d'origine du film
     *
     * @var int
     */
    public $CountriesId;

    /**
     * L'identifiant numérique du genre du film
     *
     * @var int
     */
    public $GendersCode;

    /**
     * L'identifiant numérique de l'utilisateur qui a créé le film
     *
     * @var int
     */
    public $UsersId;
 }
 ?>