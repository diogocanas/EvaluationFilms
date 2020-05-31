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
     * @brief Méthode qui récupère le rôle 
     *
     * @param int $code L'identifiant numérique du rôle par l'identifiant numériqu
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
     * @brief Méthode qui récupère l'acteur par l'identifiant numérique 
     *
     * @param string $name Le nom de l'acteur
     * @return Actor objet Actor | false sinon
     */
    public static function getActorByName($name)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, actor FROM ACTORS WHERE name LIKE :name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
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
     * Méthodes pour Country
     */

    /**
     * @brief Méthode qui récupère le pays d'origine par l'identifiant numérique 
     *
     * @param int $id L'identifiant numérique du pays d'origine
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
     * Méthodes pour Rating
     */
    /**
     * @brief Méthode qui récupère les notes par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return Rating[] tableau de Rating | false sinon
     */
    private static function getRatingsByMovieId($movieId) {
        $ratingsArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT score, remark FROM RATINGS WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($ratingsArray, new Rating($row['score'], $row['remark']));
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
    public static function getAvgRatingByMovieId($movieId) {
        $ratings = self::getRatingsByMovieId($movieId);
        $avgRating = 0;
        
        foreach ($ratings as $rating) {
            $avgRating += $rating->Score;
        }
        return $avgRating / count($ratings);
    }

    /**
     * @brief Méthode qui retourne le nombre de votes d'un film par l'identifiant numérique du film
     *
     * @param int $movieId L'identifiant numérique du film
     * @return int Le nombre de votes du film
     */
    public static function getNumberRatingsByMovieId($movieId) {
        $ratings = self::getRatingsByMovieId($movieId);
        return count($ratings);
    }

    /**
     * Méthodes pour Status
     */

    /**
     * @brief Méthode qui récupère le pays d'origine par l'identifiant numérique 
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
