<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : MovieContainer.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du container Movie
 * Version        : 1.0
 */

 /**
  * @brief Classe container de User
  */
 class UserContainer {
     
    /**
     * @brief Constructeur de la classe
     *
     * @param string $nickname Le surnom de l'utilisateur
     * @param string $email L'adresse mail de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @param string $token Le token de l'utilisateur
     * @param string $name Le nom de l'utilisateur
     * @param string $firstName Le prénom de l'utilisateur
     * @param string $avatar La photo de profil de l'utilisateur (en base64)
     * @param int $roles_id Identifiant numérique du rôle de l'utilisateur
     */
    function __construct($nickname, $email, $password, $token, $roles_id, $name = null, $firstName = null, $avatar = null)
    {
        $this->Nickname = $nickname;
        $this->Email = $email;
        $this->Password = $password;
        $this->Token = $token;
        $this->Roles_id = $roles_id;
        $this->Name = $name;
        $this->FirstName = $firstName;
        $this->Avatar = $avatar;
    }

    function __clone()
    {
    }

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
     * Le token de l'utilisateur
     *
     * @var string
     */
    public $Token;

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

    /**
     * Identifiant numérique du rôle de l'utilisateur
     *
     * @var int
     */
    public $Roles_id;
 }
