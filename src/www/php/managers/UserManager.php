<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : UserManager.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du manager User
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe manager de User
  */
 class UserManager {

     /**
     * @brief Le constructeur de la classe (privé afin que l'on ne puisse pas créer d'instances)
     */
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    /**
     * @brief Fonction qui insère un utilisateur dans la base de données
     *
     * @param User $user Utilisateur du site
     * @return bool Vrai si l'insertion à été faite, une erreur est affichée sinon
     */
    public static function createUser($user)
    {
        try {
            $user->Password = hash('sha256', $user->Password);
            $db = DatabaseManager::getInstance();
            $sql = 'INSERT INTO users(email, name, firstName, password, verified, roles_id) VALUES(:email, :name, :firstName, :password, :verified, :roles_id)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $user->Email, PDO::PARAM_STR);
            $stmt->bindParam(':name', $user->Name, PDO::PARAM_STR);
            $stmt->bindParam(':firstName', $user->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':password', $user->Password, PDO::PARAM_STR);
            $stmt->bindParam(':verified', $user->Verified, PDO::PARAM_INT);
            $stmt->bindParam(':roles_id', $user->Roles_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
 }
