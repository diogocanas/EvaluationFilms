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
class MovieManager
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
     * @brief Méthode qui insère un film dans la base de données
     *
     * @param string $title Le titre du film
     * @param string $description La description du film (résumé)
     * @param int $releaseYear L'année de sortie du film
     * @param int $duration La durée du film en minutes
     * @param $_FILES $file L'affiche du film
     * @param int $hidden La visibilité du film
     * @param string $links Les liens reliés au film
     * @param int $directorsId L'identifiant numérique du réalisateur du film
     * @param int $companiesId L'identifiant numérique de la société de production de film
     * @param int $countriesIso2 L'identifiant numérique du pays d'origine de film
     * @param int $gendersCode L'identifiant numérique du genre du film
     * @param int $usersId L'identifiant numérique de l'utilisateur qui a créé le film
     * @return bool true si l'insertion a fonctionné | false sinon
     */
    public static function create($title, $description, $releaseYear, $duration, $file, $hidden, $links, $directorsId, $companiesId, $countriesIso2, $gendersCode, $usersId)
    {
        try {
            $data = file_get_contents($file['tmp_name']);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file['tmp_name']);
            $poster = 'data:' . $mime . ';base64,' . base64_encode($data);
            if (strpos($mime, 'image') != false) {
                return false;
            }

            $db = DatabaseManager::getInstance();
            $sql = 'INSERT INTO MOVIES(title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id) VALUES(:title, :description, :release_year, :duration, :poster, :hidden, :links, :directors_id, :companies_id, :countries_iso2, :genders_code, :users_id)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':release_year', $releaseYear, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
            $stmt->bindParam(':poster', $poster, PDO::PARAM_STR);
            $stmt->bindParam(':hidden', $hidden, PDO::PARAM_INT);
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
     * @brief Méthode qui modifie un film dans la base de données
     *
     * @param int $id L'identifiant numérique du film
     * @param string $title Le titre du film
     * @param string $description La description du film (résumé)
     * @param int $releaseYear L'année de sortie du film
     * @param int $duration La durée du film en minutes
     * @param $_FILES $file L'affiche du film
     * @param string $links Les liens reliés au film
     * @param int $directorsId L'identifiant numérique du réalisateur du film
     * @param int $companiesId L'identifiant numérique de la société de production de film
     * @param int $countriesIso2 L'identifiant numérique du pays d'origine de film
     * @param int $gendersCode L'identifiant numérique du genre du film
     * @param int $usersId L'identifiant numérique de l'utilisateur qui a créé le film
     * @return bool true si la modification a fonctionnée | false sinon
     */
    public static function update($id, $title, $description, $releaseYear, $duration, $file, $links, $directorsId, $companiesId, $countriesIso2, $gendersCode, $usersId)
    {
        try {
            if ($file['tmp_name'] != "") {
                $data = file_get_contents($file['tmp_name']);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file['tmp_name']);
            $poster = 'data:' . $mime . ';base64,' . base64_encode($data);
            if (strpos($mime, 'image') != false) {
                return false;
            }
            } else {
                $poster = null;
            }

            $db = DatabaseManager::getInstance();
            $sql = 'UPDATE MOVIES SET title = :title, description = :description, release_year = :release_year, duration = :duration, ';
            if ($poster != null) {
                $sql .= 'poster = :poster,';
            }
            $sql .= 'links = :links, directors_id = :directors_id, companies_id = :companies_id, countries_iso2 = :countries_iso2, genders_code = :genders_code, users_id = :users_id WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':release_year', $releaseYear, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
            if ($poster != null) {
                $stmt->bindParam(':poster', $poster, PDO::PARAM_STR);
            }
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
            return false;
        }
        return true;
    }

    /**
     * @brief Méthode qui supprime un film dans la base de données
     *
     * @param int $id L'identifiant numérique du film
     * @return bool true si la suppression a fonctionnée | false sinon
     */
    public static function delete($id)
    {
        try {
            $db = DatabaseManager::getInstance();
            $db->beginTransaction();
            $sql = 'DELETE FROM MEDIAS WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $sql = 'DELETE FROM RATINGS WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $sql = 'DELETE FROM PARTICIPATE WHERE movies_id LIKE :movies_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':movies_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $sql = 'DELETE FROM MOVIES WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $db->commit();
        } catch (PDOException $e) {
            $db->rollBack();
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
            $sql = 'SELECT id, title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['hidden'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $moviesArray;
    }

    /**
     * @brief Méthode qui récupère tous les films visibles en base
     *
     * @return Movie[] tableau de Movie | false sinon
     */
    public static function getVisibleMovies()
    {
        $moviesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES WHERE hidden LIKE 0';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['hidden'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $moviesArray;
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
            $sql = 'SELECT id, title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES WHERE id LIKE :id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['hidden'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getActorsByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id']));
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
            $sql = 'SELECT id, title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES WHERE title LIKE :title';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['hidden'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getActorsByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id']));
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui récupère les films créés par l'utilisateur connecté
     *
     * @return Movie[] tableau de Movie | false sinon
     */
    public static function getMoviesCreatedByUserLogged()
    {
        $moviesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $sql = 'SELECT id, title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES WHERE users_id LIKE :users_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':users_id', SessionManager::getLoggedUser()->Id);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['hidden'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return $moviesArray;
    }

    /**
     * @brief Méthode qui cache (ou montre) un film 
     *
     * @param Movie $movie Le film concerné
     * @return bool true si la modification a fonctionnée | false sinon
     */
    public static function hideMovie($movie)
    {
        try {
            $db = DatabaseManager::getInstance();
            if ($movie->Hidden != 1) {
                $sql = 'UPDATE MOVIES SET hidden = 1 WHERE id LIKE :id';
            } else {
                $sql = 'UPDATE MOVIES SET hidden = 0 WHERE id LIKE :id';
            }
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $movie->Id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @brief Méthode qui sert à filtrer les films
     *
     * @param string $keyword Le mot-clé
     * @param string $gender Le genre
     * @param int $releaseYearStart L'année de sortie (début)
     * @param int $releaseYearEnd L'année de sortie (fin)
     * @param string $country Le pays d'origine
     * @param int $durationStart La durée du film en minutes (début)
     * @param int $durationEnd La durée du film en minutes (fin)
     * @return Movie[] tableau de Movie | false sinon
     */
    public static function filter($keyword, $gender, $releaseYearStart, $releaseYearEnd, $country, $durationStart, $durationEnd)
    {
        $moviesArray = array();
        try {
            $db = DatabaseManager::getInstance();
            $firstCondition = false;
            $sql = 'SELECT id, title, description, release_year, duration, poster, hidden, links, directors_id, companies_id, countries_iso2, genders_code, users_id FROM MOVIES';
            if ($keyword != "" || $gender != "Tout" || ($releaseYearStart != "" && $releaseYearEnd != "") || $country != "Tout" || ($durationStart != "" || $durationEnd != "")) {
                $sql .= ' WHERE hidden LIKE 0 AND';
                if ($keyword != "") {
                    if ($firstCondition) {
                        $sql .= ' OR title LIKE :title OR description LIKE :description)';
                    } else {
                        $sql .= ' title LIKE :title OR description LIKE :description';
                    }
                    $firstCondition = true;
                }
                if ($gender != "Tout") {
                    if ($firstCondition) {
                        $sql .= ' OR genders_code LIKE :genders_code';
                    } else {
                        $sql .= ' genders_code LIKE :genders_code';
                    }
                    $firstCondition = true;
                }
                if ($releaseYearStart != "" && $releaseYearEnd != "") {
                    if ($firstCondition) {
                        $sql .= ' OR release_year BETWEEN :releaseYearStart AND :releaseYearEnd';
                    } else {
                        $sql .= ' release_year BETWEEN :releaseYearStart AND :releaseYearEnd';
                    }
                    $firstCondition = true;
                }
                if ($country != "Tout") {
                    if ($firstCondition) {
                        $sql .= ' OR countries_iso2 LIKE :countries_iso2';
                    } else {
                        $sql .= ' countries_iso2 LIKE :countries_iso2';
                    }
                    $firstCondition = true;
                }
                if ($durationStart != "" || $durationEnd != "") {
                    if ($firstCondition) {
                        $sql .= ' OR duration BETWEEN :durationStart AND :durationEnd';
                    } else {
                        $sql .= ' duration BETWEEN :durationStart AND :durationEnd';
                    }
                    $firstCondition = true;
                }
            }
            $stmt = $db->prepare($sql);
            if ($keyword != "") {
                $keyword = '%' . $keyword . '%';
                $stmt->bindParam(':title', $keyword, PDO::PARAM_STR);
                $stmt->bindParam(':description', $keyword, PDO::PARAM_STR);
            }
            if ($gender != "Tout") {
                $stmt->bindParam(':genders_code', CodeManager::getGenderByLabel($gender)->Code, PDO::PARAM_INT);
            }
            if ($releaseYearStart != "" && $releaseYearEnd != "") {
                $stmt->bindParam(':releaseYearStart', $releaseYearStart, PDO::PARAM_INT);
                $stmt->bindParam(':releaseYearEnd', $releaseYearEnd, PDO::PARAM_INT);
            }
            if ($country != "Tout") {
                $stmt->bindParam(':countries_iso2', CodeManager::getCountryByName($country)->Iso2, PDO::PARAM_STR);
            }
            if ($durationStart != "" || $durationEnd != "") {
                $stmt->bindParam(':durationStart', $durationStart, PDO::PARAM_INT);
                $stmt->bindParam(':durationEnd', $durationEnd, PDO::PARAM_INT);
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($moviesArray, new Movie($row['id'], $row['title'], $row['description'], $row['release_year'], $row['duration'], $row['poster'], $row['hidden'], $row['links'], CodeManager::getMediasByMovieId($row['id']), CodeManager::getMediasByMovieId($row['id']), CodeManager::getDirectorById($row['directors_id']), CodeManager::getCompanyById($row['companies_id']), CodeManager::getCountryByIso2($row['countries_iso2']), CodeManager::getGenderByCode($row['genders_code']), UserManager::getById($row['users_id'])));
            }
            return $moviesArray;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}
