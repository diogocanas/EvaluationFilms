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
     * @brief Méthode qui supprime le lien entre un film et ses acteurs
     *
     * @param int $movieId L'identifiant numérique du film
     * @return bool true si la suppression a fonctionnée | false sinon
     */
    public static function deleteActorsFromMovie($movieId) {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'DELETE FROM PARTICIPATE WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
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
     * @brief Méthode qui insère des médias dans la base en les reliant à un film
     *
     * @param $_FILES $medias Les médias (images, vidéos et audios)
     * @param string $title Le titre du film
     * @return bool true si l'insertion a fonctionnée | false sinon
     */
    public static function setMediasToMovie($medias, $title)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'INSERT INTO MEDIAS(media, movies_id) VALUES(:media, :movies_id)';
            $stmt = $db->prepare($sql);
            foreach ($medias['tmp_name'] as $file) {
                $data = file_get_contents($file);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($file);
                $media = 'data:' . $mime . ';base64,' . base64_encode($data);
                if (strpos($mime, 'image') != false || strpos($mime, 'video') != false || strpos($mime, 'audio') != false) {
                    return false;
                }
                $stmt->bindParam(':media', $media, PDO::PARAM_STR);
                $stmt->bindParam(':movies_id', MovieManager::getByTitle($title)->Id, PDO::PARAM_INT);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
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
            return $avgRating / count($ratings);
        } else {
            return 0;
        }
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
     * @brief Méthode qui insère une note dans la base
     *
     * @param int $movieId L'identifiant numérique du film
     * @param int $score La note donnée par l'utilisateur
     * @param string $remark Le commentaire lié à la note
     * @return bool true si l'insertion a fonctionnée | false sinon
     */
    public static function addRateToMovie($movieId, $score, $remark)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'INSERT INTO RATINGS(users_id, movies_id, score, remark) VALUES(:users_id, :movies_id, :score, :remark)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':users_id', SessionManager::getLoggedUser()->Id, PDO::PARAM_INT);
            $stmt->bindParam(':movies_id', $movieId, PDO::PARAM_INT);
            $stmt->bindParam(':score', $score, PDO::PARAM_INT);
            $stmt->bindParam(':remark', $remark, PDO::PARAM_STR);
            if ($stmt->execute()) {
                MailManager::sendRatingMail($movieId, $score);
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
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
     * @brief Méthode qui retourne les 9 films les mieux notés
     *
     * @return Movie[] tableau de Movie | false sinon
     */
    public static function getMostRatedMovies() {
        $moviesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT movies_id, AVG(score) FROM RATINGS GROUP BY movies_id ORDER BY COUNT(score) DESC, AVG(score) DESC LIMIT 9';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (MovieManager::getById($row['movies_id'])->Hidden == 0) {
                    array_push($moviesArray, MovieManager::getById($row['movies_id']));
                }
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $moviesArray;
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

    /**
     * Méthodes pour la table PARTICIPATE
     */
    /**
     * @brief Méthode qui relie les acteurs au film
     *
     * @param string[] $actors Les acteurs choisis par l'utilisateur
     * @param string $title Le titre du film
     * @return bool true si l'insertion a fonctionnée | false sinon
     */
    public static function setActorsToMovie($actors, $title)
    {
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'INSERT INTO PARTICIPATE(actors_id, movies_id) VALUES(:actors_id, :movies_id)';
            $stmt = $db->prepare($sql);
            foreach ($actors as $actor) {
                $stmt->bindParam(':actors_id', self::getActorByName($actor)->Id, PDO::PARAM_INT);
                $stmt->bindParam(':movies_id', MovieManager::getByTitle($title)->Id, PDO::PARAM_INT);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }
}
