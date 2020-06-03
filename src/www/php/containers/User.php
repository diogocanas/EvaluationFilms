<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : User.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du container User
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe container de User
  */
 class User {
     
    /**
     * @brief Constructeur de la classe
     *
     * @param int $id L'identifiant numérique de l'utilisateur
     * @param string $nickname Le surnom de l'utilisateur
     * @param string $email L'adresse mail de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @param string $salt Le salt de l'utilisateur
     * @param string $token Le token de l'utilisateur
     * @param Role $role Rôle de l'utilisateur
     * @param Status $status Status de l'utilisateur
     * @param string $name Le nom de l'utilisateur
     * @param string $firstName Le prénom de l'utilisateur
     * @param string $avatar La photo de profil de l'utilisateur (en base64)
     */
    function __construct($id, $nickname, $email, $password, $salt, $token, $role, $status, $name = null, $firstName = null, $avatar = null)
    {
        $this->Id = $id;
        $this->Nickname = $nickname;
        $this->Email = $email;
        $this->Password = $password;
        $this->Salt = $salt;
        $this->Token = $token;
        $this->Role = $role;
        $this->Status = $status;
        $this->Name = $name;
        $this->FirstName = $firstName;
        $this->Avatar = $avatar;
    }

    function __clone()
    {
    }

    /**
     * L'identifiant numérique de l'utilisateur
     *
     * @var int
     */
    public $Id;

    /**
     * Le surnom de l'utilisateur
     *
     * @var string
     */
    public $Nickname;

    /**
     * L'adresse mail de l'utilisateur
     *
     * @var string
     */
    public $Email;

    /**
     * Le mot de passe de l'utilisateur
     *
     * @var string
     */
    public $Password;

    /**
     * Le salt de l'utilisateur
     *
     * @var string
     */
    public $Salt;

    /**
     * Le token de l'utilisateur
     *
     * @var string
     */
    public $Token;

    /**
     * Le rôle de l'utilisateur
     *
     * @var Role
     */
    public $Role;

    /**
     * Le statut de l'utilisateur
     *
     * @var Status
     */
    public $Status;

    /**
     * Le nom de l'utilisateur
     *
     * @var string
     */
    public $Name;

    /**
     * Le prénom de l'utilisateur
     *
     * @var string
     */
    public $FirstName;

    /**
     * La photo de profil de l'utilisateur (en base64)
     *
     * @var string
     */
    public $Avatar;
 }
