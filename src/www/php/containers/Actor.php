<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Actor.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Actor
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Actor
  */
 class Actor {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique de l'acteur
     * @param string $actor Le nom de l'acteur
     */
    function __construct($id, $actor)
    {
        $this->Id = $id;
        $this->Actor = $actor;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique du réalisateur
     *
     * @var int
     */
    public $Id;

    /**
     * Le nom du réalisateur
     *
     * @var string
     */
    public $Actor;
 }
 ?>