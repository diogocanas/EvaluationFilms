<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : Rating.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 27 mai 2020
 * Description    : Fichier du container Rating
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de Rating
  */
 class Rating {

    /**
     * @brief Constructeur de la classe
     * @param int $score La note donnée par l'utilisateur
     * @param string $remark Le commentaire de la note
     * @param User $usersId Lutilisateur qui a noté
     */
    function __construct($score, $remark, $user)
    {
        $this->Score = $score;
        $this->Remark = $remark;
        $this->User = $user;
    }

    function __clone()
    {
    }

    /**
     * La note donnée par l'utilisateur
     *
     * @var int
     */
    public $Score;
    
    /**
     * Le commentaire de la note
     *
     * @var string
     */
    public $Remark;

    /**
     * L'utilisateur qui a noté
     *
     * @var User
     */
    public $User;
 }
 ?>