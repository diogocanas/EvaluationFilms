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
-- Table `evaluationFilms`.`STATUS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`STATUS` (
  `code` INT NOT NULL,
  `label` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`ROLES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`ROLES` (
  `code` INT NOT NULL,
  `label` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`code`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`USERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`USERS` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `name` VARCHAR(50) NULL,
  `first_name` VARCHAR(50) NULL,
  `avatar` LONGTEXT NULL,
  `roles_code` INT NOT NULL,
  `status_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_USERS_STATUS1_idx` (`status_id` ASC),
  UNIQUE INDEX `salt_UNIQUE` (`salt` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_USERS_ROLES1_idx` (`roles_code` ASC),
  CONSTRAINT `fk_USERS_STATUS1`
    FOREIGN KEY (`status_id`)
    REFERENCES `evaluationFilms`.`STATUS` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USERS_ROLES1`
    FOREIGN KEY (`roles_code`)
    REFERENCES `evaluationFilms`.`ROLES` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`GENDERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`GENDERS` (
  `code` INT NOT NULL,
  `label` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`code`))
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
  `iso2` VARCHAR(2) NOT NULL,
  `country` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`iso2`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`MOVIES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`MOVIES` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `release_year` INT NOT NULL,
  `duration` INT NOT NULL,
  `poster` LONGTEXT NOT NULL,
  `hidden` INT NOT NULL,
  `links` LONGTEXT NULL,
  `directors_id` INT NOT NULL,
  `companies_id` INT NOT NULL,
  `countries_iso2` VARCHAR(2) NOT NULL,
  `genders_code` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_MOVIES_DIRECTORS1_idx` (`directors_id` ASC),
  INDEX `fk_MOVIES_COMPANIES1_idx` (`companies_id` ASC),
  INDEX `fk_MOVIES_USERS1_idx` (`users_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC),
  INDEX `fk_MOVIES_GENDERS1_idx` (`genders_code` ASC),
  INDEX `fk_MOVIES_COUNTRIES1_idx` (`countries_iso2` ASC),
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
  CONSTRAINT `fk_MOVIES_USERS1`
    FOREIGN KEY (`users_id`)
    REFERENCES `evaluationFilms`.`USERS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MOVIES_GENDERS1`
    FOREIGN KEY (`genders_code`)
    REFERENCES `evaluationFilms`.`GENDERS` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MOVIES_COUNTRIES1`
    FOREIGN KEY (`countries_iso2`)
    REFERENCES `evaluationFilms`.`COUNTRIES` (`iso2`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evaluationFilms`.`RATINGS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evaluationFilms`.`RATINGS` (
  `users_id` INT NOT NULL,
  `movies_id` INT NOT NULL,
  `score` INT NOT NULL,
  `remark` LONGTEXT NULL,
  INDEX `fk_NOTES_USERS1_idx` (`users_id` ASC),
  INDEX `fk_NOTES_MOVIES1_idx` (`movies_id` ASC),
  PRIMARY KEY (`users_id`, `movies_id`),
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
  PRIMARY KEY (`actors_id`, `movies_id`),
  INDEX `fk_ACTORS_has_MOVIES_MOVIES1_idx` (`movies_id` ASC),
  INDEX `fk_ACTORS_has_MOVIES_ACTORS1_idx` (`actors_id` ASC),
  CONSTRAINT `fk_ACTORS_has_MOVIES_ACTORS1`
    FOREIGN KEY (`actors_id`)
    REFERENCES `evaluationFilms`.`ACTORS` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACTORS_has_MOVIES_MOVIES1`
    FOREIGN KEY (`movies_id`)
    REFERENCES `evaluationFilms`.`MOVIES` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
