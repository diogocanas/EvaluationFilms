<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Movie.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du container Movie
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

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
     * @param int $duration La durée du film en minutes
     * @param string $poster L'affiche du film (en base64)
     * @param string $links Les liens reliés au film
     * @param string $medias Les médias reliés au film
     * @param int $director Le réalisateur du film
     * @param int $company La société de production du film
     * @param int $country Le pays d'origine du film
     * @param int $gender Le genre du film
     * @param int $user L'utilisateur qui a créé le film
     */
    function __construct($id, $title, $description, $releaseYear, $duration, $poster, $links, $medias, $actors, $director, $company, $country, $gender, $user)
    {
        $this->Id = $id;
        $this->Title = $title;
        $this->Description = $description;
        $this->ReleaseYear = $releaseYear;
        $this->Duration = $duration;
        $this->Poster = $poster;
        $this->Links = $links;
        $this->Medias = $medias;
        $this->Actors = $actors;
        $this->Director = $director;
        $this->Company = $company;
        $this->Country = $country;
        $this->Gender = $gender;
        $this->User = $user;
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
     * La durée du film en minutes
     *
     * @var int
     */
    public $Duration;

    /**
     * L'affiche du film (en base64)
     *
     * @var string
     */
    public $Poster;

    /**
     * Liens reliés au film
     *
     * @var string
     */
    public $Links;

    /**
     * Médias reliés au film
     *
     * @var Media[]
     */
    public $Medias;

    /**
     * Acteurs du film
     *
     * @var Actor[]
     */
    public $Actors;

    /**
     * Réalisateur du film
     *
     * @var Director
     */
    public $Director;

    /**
     * Société de production du film
     *
     * @var Company
     */
    public $Company;

    /**
     * Pays d'origine du film
     *
     * @var Country
     */
    public $Country;

    /**
     * Genre du film
     *
     * @var Gender
     */
    public $Gender;

    /**
     * Utilisateur qui a créé le film
     *
     * @var User
     */
    public $User;
 }
 ?>