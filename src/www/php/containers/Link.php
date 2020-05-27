<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Link.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Link
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Link
  */
 class Link {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique du lien
     * @param string $link Lien relié au film
     * @param int $moviesId L'identifiant numérique du film
     */
    function __construct($id, $link, $moviesId)
    {
        $this->Id = $id;
        $this->Link = $link;
        $this->MoviesId = $moviesId;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique du lien
     *
     * @var int
     */
    public $Id;

    /**
     * Lien relié au film
     *
     * @var string
     */
    public $Link;

    /**
     * L'identifiant numérique du film
     *
     * @var int
     */
    public $MoviesId;
 }
 ?>