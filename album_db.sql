-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema albums_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema albums_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `albums_db` DEFAULT CHARACTER SET utf8 ;
USE `albums_db` ;

-- -----------------------------------------------------
-- Table `albums_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `albums_db`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `name` VARCHAR(105) NULL DEFAULT NULL,
  `password` VARCHAR(20) NOT NULL,
  `is_admin` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `albums_db`.`albums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `albums_db`.`albums` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `created_on` DATETIME NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_id_idx` (`user_id` ASC),
  CONSTRAINT `albums_users_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `albums_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `albums_db`.`photos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `albums_db`.`photos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(100) NOT NULL,
  `album_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `path_UNIQUE` (`path` ASC),
  INDEX `photos_albums_fk_idx` (`album_id` ASC),
  CONSTRAINT `photos_albums_fk`
    FOREIGN KEY (`album_id`)
    REFERENCES `albums_db`.`albums` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
