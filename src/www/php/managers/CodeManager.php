<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : CodeManager.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier qui contient les managaers des tables de code
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';

/**
 * @brief Classe manager des tables de code
 */
class CodeManager
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
     * Méthodes pour Role
     */

    /**
     * @brief Méthode qui récupère le rôle par l'identifiant numérique
     *
     * @param int $code L'identifiant numérique du rôle
     * @return Role objet Role | false sinon
     */
    public static function getRoleByCode($code)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT code, label FROM ROLES WHERE code LIKE :code';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Role($row['code'], $row['label']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Méthodes pour Gender
     */

    /**
     * @brief Méthode qui récupère le genre par l'identifiant numérique 
     *
     * @param int $code L'identifiant numérique du genre
     * @return Gender objet Gender | false sinon
     */
    public static function getGenderByCode($code)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT code, label FROM GENDERS WHERE code LIKE :code';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Gender($row['code'], $row['label']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère le genre par le nom
     *
     * @param string $label Le nom du genre
     * @return Gender objet Gender | false sinon
     */
    public static function getGenderByLabel($label)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT code, label FROM GENDERS WHERE label LIKE :label';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':label', $label, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Gender($row['code'], $row['label']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère tous les genres en base
     *
     * @return Gender[] tableau de Gender | false sinon
     */
    public static function getAllGenders()
    {
        $gendersArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT code, label FROM GENDERS ORDER BY label ASC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($gendersArray, new Gender($row['code'], $row['label']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $gendersArray;
    }

    /**
     * Méthodes pour Director
     */

    /**
     * @brief Méthode qui récupère le réalisateur par l'identifiant numérique 
     *
     * @param int $id L'identifiant numérique du réalisateur
     * @return Director objet Director | false sinon
     */
    public static function getDirectorById($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, director FROM DIRECTORS WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Director($row['id'], $row['director']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère le réalisateur par le nom 
     *
     * @param string $name Le nom du réalisateur
     * @return Director objet Director | false sinon
     */
    public static function getDirectorByName($name)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, director FROM DIRECTORS WHERE director LIKE :director';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':director', $name, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Director($row['id'], $row['director']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère tous les réalisateurs en base
     *
     * @return Director[] tableau de Director | false sinon
     */
    public static function getAllDirectors()
    {
        $directorsArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, director FROM DIRECTORS ORDER BY director ASC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($directorsArray, new Director($row['id'], $row['director']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $directorsArray;
    }

    /**
     * Méthodes pour Actor
     */

    /**
     * @brief Méthode qui récupère l'acteur par l'identifiant numérique 
     *
     * @param int $id L'identifiant numérique de l'acteur
     * @return Actor objet Actor | false sinon
     */
    public static function getActorById($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, actor FROM ACTORS WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Actor($row['id'], $row['actor']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère l'acteur par le nom
     *
     * @param string $name Le nom de l'acteur
     * @return Actor objet Actor | false sinon
     */
    public static function getActorByName($name)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, actor FROM ACTORS WHERE actor LIKE :actor';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':actor', $name, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Actor($row['id'], $row['actor']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère les acteurs par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return Actor[] tableau de Actor | false sinon
     */
    public static function getActorsByMovieId($movieId)
    {
        $actorsArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT a.id, a.actor FROM ACTORS AS a JOIN PARTICIPATE AS p ON a.id = p.actors_id JOIN MOVIES AS m ON m.id = p.movies_id WHERE p.movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($actorsArray, new Actor($row['id'], $row['actor']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $actorsArray;
    }

    /**
     * @brief Méthode qui récupère tous les acteurs en base
     *
     * @return Actor[] tableau de Actor | false sinon
     */
    public static function getAllActors()
    {
        $actorsArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, actor FROM ACTORS ORDER BY actor ASC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($actorsArray, new Actor($row['id'], $row['actor']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $actorsArray;
    }

    /**
     * Méthodes pour Company
     */

    /**
     * @brief Méthode qui récupère la société de production par l'identifiant numérique 
     *
     * @param int $id L'identifiant numérique de la société de production
     * @return Company objet Company | false sinon
     */
    public static function getCompanyById($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, company FROM COMPANIES WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Company($row['id'], $row['company']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère la société de production par le nom
     *
     * @param string $name Le nom de la société de production
     * @return Company objet Company | false sinon
     */
    public static function getCompanyByName($name)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, company FROM COMPANIES WHERE company LIKE :company';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':company', $name, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Company($row['id'], $row['company']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère toutes les sociétés de production en base
     *
     * @return Company[] tableau de Company | false sinon
     */
    public static function getAllCompanies()
    {
        $companiesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, company FROM COMPANIES ORDER BY company ASC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($companiesArray, new Company($row['id'], $row['company']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $companiesArray;
    }

    /**
     * Méthodes pour Country
     */

    /**
     * @brief Méthode qui récupère le pays d'origine par l'identifiant 
     *
     * @param string $iso2 L'identifiant du pays d'origine
     * @return Country objet Country | false sinon
     */
    public static function getCountryByIso2($iso2)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT iso2, country FROM COUNTRIES WHERE iso2 LIKE :iso2';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':iso2', $iso2, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Country($row['iso2'], $row['country']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère le pays d'origine par le nom
     *
     * @param string $name L'identifiant numérique du pays d'origine
     * @return Country objet Country | false sinon
     */
    public static function getCountryByName($name)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT iso2, country FROM COUNTRIES WHERE country LIKE :country';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':country', $name, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Country($row['iso2'], $row['country']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère tous les pays d'origine en base
     *
     * @return Country[] tableau de Country | false sinon
     */
    public static function getAllCountries()
    {
        $countriesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT iso2, country FROM COUNTRIES ORDER BY country ASC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($countriesArray, new Country($row['iso2'], $row['country']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $countriesArray;
    }

    /**
     * Méthodes pour Media
     */

    /**
     * @brief Méthode qui récupère le média par l'identifiant numérique 
     *
     * @param int $id L'identifiant numérique du média
     * @return Media objet Media | false sinon
     */
    public static function getMediaById($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, media, movies_id FROM MEDIAS WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Media($row['id'], $row['media'], $row['movies_id']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère les médias par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return Media[] tableau de Media | false sinon
     */
    public static function getMediasByMovieId($movieId)
    {
        $mediasArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, media, movies_id FROM MEDIAS WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($mediasArray, new Media($row['id'], $row['media'], $row['movies_id']));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $mediasArray;
    }

    

    /**
     * @brief Méthode qui supprime un média
     *
     * @param int $mediaId L'identifiant numérique du média
     * @return bool true si la suppression a fonctionnée | false sinon
     */
    public static function deleteMediaById($mediaId) {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'DELETE FROM MEDIAS WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $mediaId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Méthodes pour Rating
     */
    /**
     * @brief Méthode qui récupère les notes par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return Rating[] tableau de Rating | false sinon
     */
    public static function getRatingsByMovieId($movieId)
    {
        $ratingsArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT score, remark, users_id FROM RATINGS WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($ratingsArray, new Rating($row['score'], $row['remark'], UserManager::getById($row['users_id'])));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $ratingsArray;
    }

    /**
     * @brief Méthode qui calcule la note moyenne par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return double La note moyenne du film
     */
    public static function getAvgRatingByMovieId($movieId)
    {
        $ratings = self::getRatingsByMovieId($movieId);
        $avgRating = 0;

        if (count($ratings) > 0) {
            foreach ($ratings as $rating) {
                $avgRating += $rating->Score;
            }
            $avgRating /= count($ratings);
        }
        return $avgRating;
    }

    /**
     * @brief Méthode qui retourne le nombre de votes d'un film par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return int Le nombre de votes du film
     */
    public static function getNumberRatingsByMovieId($movieId)
    {
        $ratings = self::getRatingsByMovieId($movieId);
        return count($ratings);
    }

    /**
     * @brief Méthode qui vérifie si l'utilisateur a déjà noté le film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return bool true si l'utilisateur n'a pas encore noté | false sinon
     */
    public static function alreadyRated($movieId)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT COUNT(score) AS nb_score FROM RATINGS WHERE users_id LIKE :users_id AND movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':users_id', SessionManager::getLoggedUser()->Id, PDO::PARAM_INT);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['nb_score'] > 0) {
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
     * Méthodes pour Status
     */

    /**
     * @brief Méthode qui récupère le statut par l'identifiant numérique 
     *
     * @param int $code L'identifiant numérique du statut
     * @return Status objet Status | false sinon
     */
    public static function getStatusByCode($code)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT code, label FROM STATUS WHERE code LIKE :code';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Status($row['code'], $row['label']);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}