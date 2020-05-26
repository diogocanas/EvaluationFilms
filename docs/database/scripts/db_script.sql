-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema evaluationFilms
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema evaluationFilms
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `evaluationFilms` DEFAULT CHARACTER SET utf8 ;
USE `evaluationFilms` ;

-- -----------------------------------------------------
-- Table `evaluationFilms`.`ROLES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`ROLES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `role_UNIQUE` (`role` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`USERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`USERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `token` VARCHAR(100) NOT NULL,
  `name` VARCHAR(50) NULL,
  `first_name` VARCHAR(50) NULL,
  `avatar` LONGTEXT NULL,
  `roles_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_USERS_ROLES1_idx` (`roles_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_USERS_ROLES1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `evaluationFilms`.`ROLES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`GENDERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`GENDERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gender` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`DIRECTORS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`DIRECTORS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `director` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `director_UNIQUE` (`director` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`ACTORS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`ACTORS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `actor` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `actor_UNIQUE` (`actor` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`COMPANIES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`COMPANIES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `company` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `company_UNIQUE` (`company` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`COUNTRIES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`COUNTRIES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `country_UNIQUE` (`country` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`MOVIES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`MOVIES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `release_year` INT NOT NULL,
  `duration` DATETIME NOT NULL,
  `poster` LONGTEXT NOT NULL,
  `directors_id` INT NOT NULL,
  `companies_id` INT NOT NULL,
  `countries_id` INT NOT NULL,
  `genders_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_MOVIES_DIRECTORS1_idx` (`directors_id` ASC),
  INDEX `fk_MOVIES_COMPANIES1_idx` (`companies_id` ASC),
  INDEX `fk_MOVIES_COUNTRIES1_idx` (`countries_id` ASC),
  INDEX `fk_MOVIES_GENDERS1_idx` (`genders_id` ASC),
  INDEX `fk_MOVIES_USERS1_idx` (`users_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC),
  CONSTRAINT `fk_MOVIES_DIRECTORS1`
    FOREIGN KEY (`directors_id`)
    REFERENCES `evaluationFilms`.`DIRECTORS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MOVIES_COMPANIES1`
    FOREIGN KEY (`companies_id`)
    REFERENCES `evaluationFilms`.`COMPANIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MOVIES_COUNTRIES1`
    FOREIGN KEY (`countries_id`)
    REFERENCES `evaluationFilms`.`COUNTRIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MOVIES_GENDERS1`
    FOREIGN KEY (`genders_id`)
    REFERENCES `evaluationFilms`.`GENDERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MOVIES_USERS1`
    FOREIGN KEY (`users_id`)
    REFERENCES `evaluationFilms`.`USERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`RATINGS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`RATINGS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rating` INT NOT NULL,
  `users_id` INT NOT NULL,
  `movies_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_NOTES_USERS1_idx` (`users_id` ASC),
  INDEX `fk_NOTES_MOVIES1_idx` (`movies_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_NOTES_USERS1`
    FOREIGN KEY (`users_id`)
    REFERENCES `evaluationFilms`.`USERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_NOTES_MOVIES1`
    FOREIGN KEY (`movies_id`)
    REFERENCES `evaluationFilms`.`MOVIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`LINKS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`LINKS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `link` VARCHAR(150) NOT NULL,
  `movies_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_LINKS_MOVIES1_idx` (`movies_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_LINKS_MOVIES1`
    FOREIGN KEY (`movies_id`)
    REFERENCES `evaluationFilms`.`MOVIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`MEDIAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`MEDIAS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `media` LONGTEXT NOT NULL,
  `movies_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_MEDIAS_MOVIES1_idx` (`movies_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_MEDIAS_MOVIES1`
    FOREIGN KEY (`movies_id`)
    REFERENCES `evaluationFilms`.`MOVIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`PARTICIPATE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`PARTICIPATE` (
  `actors_id` INT NOT NULL,
  `movies_id` INT NOT NULL,
  INDEX `fk_PARTICIPATE_ACTORS1_idx` (`actors_id` ASC),
  INDEX `fk_PARTICIPATE_MOVIES1_idx` (`movies_id` ASC),
  CONSTRAINT `fk_PARTICIPATE_ACTORS1`
    FOREIGN KEY (`actors_id`)
    REFERENCES `evaluationFilms`.`ACTORS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PARTICIPATE_MOVIES1`
    FOREIGN KEY (`movies_id`)
    REFERENCES `evaluationFilms`.`MOVIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;