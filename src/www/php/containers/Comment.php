<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Comment.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Comment
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Comment
  */
 class Comment {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique du lien
     * @param string $comment Commentaire
     * @param int $moviesId L'identifiant numérique du film
     */
    function __construct($id, $comment, $moviesId)
    {
        $this->Id = $id;
        $this->Comment = $comment;
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
     * Commentaire
     *
     * @var string
     */
    public $Comment;

    /**
     * L'identifiant numérique du film
     *
     * @var int
     */
    public $MoviesId;
 }
 ?>