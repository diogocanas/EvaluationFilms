<?php
/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : MovieManager.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du manager Movie
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

 /**
  * @brief Classe manager de Movie
  */
 class MovieManager {

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
     * @brief Méthode qui insère un film dans la base de données
     *
     * @param string $title Le titre du film
     * @param string $description La description du film (résumé)
     * @param int $releaseYear L'année de sortie du film
     * @param int $duration La durée du film en minutes
     * @param string $poster L'affiche du film
     * @param string $links Les liens reliés au film
     * @param int $directorsId L'identifiant numérique du réalisateur du film
     * @param int $companiesId L'identifiant numérique de la société de production de film
     * @param int $countriesIso2 L'identifiant numérique du pays d'origine de film
     * @param int $gendersCode L'identifiant numérique du genre du film
     * @param int $usersId L'identifiant numérique de l'utilisateur qui a créé le film
     * @return bool true si l'insertion a fonctionné | false sinon
     */
    public static function create($title, $description, $releaseYear, $duration, $poster, $links, $directorsId, $companiesId, $countriesIso2, $gendersCode, $usersId)
    {
        try {
            $db = DatabaseManager::getInstance();
            $db->beginTransaction();
            $sql = 'INSERT INTO MOVIES(title, description, release_year, duration, poster, links, directors_id, companies_id, countries_iso2, genders_code, users_id) VALUES(:title, :description, :release_year, :duration, :poster, :links, :directors_id, :companies_id, :countries_iso2, :genders_code, :users_id)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':release_year', $releaseYear, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
            $stmt->bindParam(':poster', $poster, PDO::PARAM_STR);
            $stmt->bindParam(':links', $links, PDO::PARAM_STR);
            $stmt->bindParam(':directors_id', $directorsId, PDO::PARAM_INT);
            $stmt->bindParam(':companies_id', $companiesId, PDO::PARAM_INT);
            $stmt->bindParam(':countries_iso2', $countriesIso2, PDO::PARAM_STR);
            $stmt->bindParam(':genders_code', $gendersCode, PDO::PARAM_INT);
            $stmt->bindParam(':users_id', $usersId, PDO::PARAM_INT);
            $stmt->execute();
            return $db->commit();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $db->rollBack();
            return false;
        }
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
    public static function update($id, $title, $description, $releaseYear, $duration, $poster, $links, $directorsId, $companiesId, $countriesIso2, $gendersCode, $usersId)
    {
        try {
            $db = DatabaseManager::getInstance();
            $db->beginTransaction();
            $sql = 'UPDATE MOVIES SET title = :title, description = :description, release_year = :release_year, duration = :duration, poster = :poster, links = :links, directors_id = :directors_id, companies_id = :companies_id, countries_iso2 = :countries_iso2, genders_code = :genders_code, users_id = :users_id WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':release_year', $releaseYear, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
            $stmt->bindParam(':poster', $poster, PDO::PARAM_STR);
            $stmt->bindParam(':links', $links, PDO::PARAM_STR);
            $stmt->bindParam(':directors_id', $directorsId, PDO::PARAM_INT);
            $stmt->bindParam(':companies_id', $companiesId, PDO::PARAM_INT);
            $stmt->bindParam(':countries_iso2', $countriesIso2, PDO::PARAM_STR);
            $stmt->bindParam(':genders_code', $gendersCode, PDO::PARAM_INT);
            $stmt->bindParam(':users_id', $usersId, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $db->commit();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $db->rollBack();
            return false;
        }
    }

    /**
     * @brief Méthode qui modifie un utilisateur dans la base de données
     *
     * @param int $id 
     * @return bool true si la modification a fonctionné | false sinon
     */
    public static function delete($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $db->beginTransaction();
            $sql = 'DELETE FROM MOVIES WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $db->commit();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $db->rollBack();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère tous les films en base
     *
     * @return Movie[] tableau de Movie | false sinon
     */
    public static function getAll()
    {
        try {
            $moviesArray = array();
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, title, description, release_year, duration, poster, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES';
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $db->commit();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
            return $moviesArray;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $db->rollBack();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère le film par l'identifiant numérique
     *
     * @return Movie objet Movie | false sinon
     */
    public static function getById($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, title, description, release_year, duration, poster, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES WHERE id LIKE :id';
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $db->commit();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id']));
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $db->rollBack();
            return false;
        }
    }
 }