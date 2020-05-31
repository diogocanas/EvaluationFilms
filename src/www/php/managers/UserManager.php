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
class UserManager
{

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
     * @brief Méthode qui insère un utilisateur dans la base de données
     *
     * @param string $nickname Le surnom de l'utilisateur
     * @param string $email L'email de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @return bool true si l'insertion a fonctionné | false sinon
     */
    public static function create($nickname, $email, $password)
    {
        try {
            $salt = hash('sha256', microtime());
            $token = hash('sha256', $email . date('Y-m-d H:i:s'));
            $password = hash('sha256', $password) . $salt;
            $rolesCode = 1;
            $statusId = 1;

            $db = DatabaseManager::getInstance();
            $sql = 'INSERT INTO USERS(nickname, email, password, salt, token, roles_code, status_id) VALUES(:nickname, :email, :password, :salt, :token, :roles_code, :status_id)';
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->bindParam(':roles_code', $rolesCode, PDO::PARAM_INT);
            $stmt->bindParam(':status_id', $statusId, PDO::PARAM_INT);
            $stmt->execute();
            MailManager::sendConfirmAccount($email);
            $db->commit();
        } catch (PDOException $e) {
            $db->rollBack();
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @brief Méthode qui modifie un utilisateur dans la base de données
     *
     * @param string $nickname Le surnom de l'utilisateur
     * @param string $name Le nom de l'utilisateur
     * @param string $firstName Le prénom de l'utilisateur
     * @param string $avatar La photo de profil de l'utilisateur
     * @return bool true si la modification a fonctionné | false sinon
     */
    public static function update($nickname, $name, $firstName, $avatar, $email)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'UPDATE USERS SET nickname = :nickname, name = :name, first_name = :first_name, avatar = :avatar WHERE email LIKE :email';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @brief Méthode qui vérifie le compte d'un utilisateur
     *
     * @param string $nickname Le surnom de l'utilisateur
     * @param string $token Le token de l'utilisateur
     * @return bool true si le compte est vérifié | false sinon
     */
    public static function confirmAccount($nickname, $token)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'UPDATE USERS SET status_id = 2 WHERE nickname LIKE :nickname AND token LIKE :token';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @brief Méthode qui vérifie les données d'un utilisateur avant son login
     *
     * @param string $email Adresse mail de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return bool true si l'utilisateur est authentifié | false sinon
     */
    public static function login($email, $password)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, password, salt, status_id FROM USERS WHERE email LIKE :email';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['password'] == hash('sha256', $password) . $row['salt']) {
                    if ($row['status_id'] == 2) {
                        SessionManager::setIsLogged(true);
                        SessionManager::setLoggedUser(self::getById($row['id']));
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui indique si le nickname ou l'email est déjà utilisé par un autre compte
     *
     * @param string $nickname Le nickname de l'utilisateur
     * @param string $email L'adresse mail de l'utilisateur
     * @return bool true si l'email est libre | false sinon
     */
    public static function exist($nickname, $email)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT COUNT(*) as nb_users FROM USERS WHERE nickname LIKE :nickname OR email LIKE :email';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['nb_users'] > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère tous les utilisateurs en base
     *
     * @return User[] tableau de User | false sinon
     */
    public static function getAll()
    {
        $usersArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, nickname, email, password, salt, token, name, first_name, avatar, roles_code, status_id FROM USERS';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($usersArray, new User($row['id'], $row['nickname'], $row['email'], $row['password'], $row['token'], $row['name'], $row['first_name'], $row['avatar'], $row['roles_code'], $row['status_id']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $usersArray;
    }

    /**
     * @brief Méthode qui récupère l'utilisateur par l'identifiant numérique
     *
     * @param int $id L'identifiant numérique de l'utilisateur
     * @return User objet User | false sinon
     */
    public static function getById($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, nickname, email, password, salt, token, name, first_name, avatar, roles_code, status_id FROM USERS WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($row['id'], $row['nickname'], $row['email'], $row['password'], $row['salt'], $row['token'], CodeManager::getRoleByCode($row['roles_code']), CodeManager::getStatusByCode(($row['status_id'])), $row['name'], $row['first_name'], $row['avatar']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère l'utilisateur par l'adresse mail
     *
     * @param string $email L'adresse mail de l'utilisateur
     * @return User objet User | false sinon
     */
    public static function getByEmail($email)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, nickname, email, password, salt, token, name, first_name, avatar, roles_code, status_id FROM USERS WHERE email LIKE :email';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($row['id'], $row['nickname'], $row['email'], $row['password'], $row['salt'], $row['token'], CodeManager::getRoleByCode($row['roles_code']), CodeManager::getStatusByCode(($row['status_id'])), $row['name'], $row['first_name'], $row['avatar']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}
