<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Media.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Media
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Media
  */
 class Media {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique du média
     * @param string $media Média converti en base64
     * @param int $moviesId L'identifiant numérique du film
     */
    function __construct($id, $media, $moviesId)
    {
        $this->Id = $id;
        $this->Media = $media;
        $this->MoviesId = $moviesId;
    }

    /**
     * L'identifiant numérique du lien
     *
     * @var int
     */
    public $Id;

    /**
     * Média converti en base64
     *
     * @var string
     */
    public $Media;

    /**
     * L'identifiant numérique du film
     *
     * @var int
     */
    public $MoviesId;
 }
 ?>