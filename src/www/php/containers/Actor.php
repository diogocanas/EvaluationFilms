<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Actor.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Actor
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

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

    /**
     * L'identifiant numérique de l'acteur
     *
     * @var int
     */
    public $Id;

    /**
     * Le nom de l'acteur
     *
     * @var string
     */
    public $Actor;
 }
 ?>