<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Director.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Director
 * Version        : 1.0
 */

 /**
  * @brief Classe container de Director
  */
 class Director {

    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique du réalisateur
     * @param string $director Le nom du réalisateur
     */
    function __construct($id, $director)
    {
        $this->Id = $id;
        $this->Director = $director;
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
    public $Director;
 }
 ?>