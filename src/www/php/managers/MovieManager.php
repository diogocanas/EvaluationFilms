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
     * @param $_FILES $file L'image du film
     * @param string $links Les liens reliés au film
     * @param int $directorsId L'identifiant numérique du réalisateur du film
     * @param int $companiesId L'identifiant numérique de la société de production de film
     * @param int $countriesIso2 L'identifiant numérique du pays d'origine de film
     * @param int $gendersCode L'identifiant numérique du genre du film
     * @param int $usersId L'identifiant numérique de l'utilisateur qui a créé le film
     * @return bool true si l'insertion a fonctionné | false sinon
     */
    public static function create($title, $description, $releaseYear, $duration, $file, $links, $directorsId, $companiesId, $countriesIso2, $gendersCode, $usersId)
    {
        try {
            $data = file_get_contents($file['tmp_name']);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file['tmp_name']);
            $poster = 'data:' . $mime . ';base64,' . base64_encode($data);

            $db = DatabaseManager::getInstance();
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
        } catch (PDOException $e) {
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
    public static function update($id, $title, $description, $releaseYear, $duration, $poster, $links, $directorsId, $companiesId, $countriesIso2, $gendersCode, $usersId)
    {
        try {
            $db = DatabaseManager::getInstance();
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
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $db->rollBack();
            return false;
        }
        return true;
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
            $sql = 'DELETE FROM MOVIES WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @brief Méthode qui indique si le film existe déjà
     *
     * @param string $title Le titre du film
     * @return bool true si le film n'existe pas | false sinon
     */
    public static function exist($title)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT COUNT(*) as movie FROM MOVIES WHERE title LIKE :title';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['movie'] > 0) {
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
     * @brief Méthode qui récupère tous les films en base
     *
     * @return Movie[] tableau de Movie | false sinon
     */
    public static function getAll()
    {
        $moviesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, title, description, release_year, duration, poster, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $moviesArray;
    }

    /*public static function getBetterRated() {
        $moviesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT m.id, m.title, m.description, m.release_year, m.duration, m.poster, m.links, m.directors_id, m.companies_id, m.countries_iso2, m.genders_code, m.users_id FROM MOVIES AS m JOIN RATINGS AS r WHERE r.movies_id = m.id AND AVG(r.score) AND COUNT(r.score) LIMIT 9';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $moviesArray;
    }*/

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
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getActorsByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id']));
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère le film par le titre
     *
     * @return Movie objet Movie | false sinon
     */
    public static function getByTitle($title)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, title, description, release_year, duration, poster, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES WHERE title LIKE :title';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getActorsByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id']));
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
 }