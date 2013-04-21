SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `whatplaynext` ;
CREATE SCHEMA IF NOT EXISTS `whatplaynext` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `whatplaynext` ;

-- -----------------------------------------------------
-- Table `whatplaynext`.`tunes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `whatplaynext`.`tunes` ;

CREATE  TABLE IF NOT EXISTS `whatplaynext`.`tunes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whatplaynext`.`books`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `whatplaynext`.`books` ;

CREATE  TABLE IF NOT EXISTS `whatplaynext`.`books` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `image_path` TEXT NULL ,
  `url_amazon` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whatplaynext`.`books_tunes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `whatplaynext`.`books_tunes` ;

CREATE  TABLE IF NOT EXISTS `whatplaynext`.`books_tunes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `book_id` INT NOT NULL ,
  `tune_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whatplaynext`.`samples`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `whatplaynext`.`samples` ;

CREATE  TABLE IF NOT EXISTS `whatplaynext`.`samples` (
  `id` INT UNSIGNED NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `tune_id` INT UNSIGNED NOT NULL ,
  `url` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `whatplaynext` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
