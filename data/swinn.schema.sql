-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema swinn
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema swinn
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `swinn` DEFAULT CHARACTER SET utf8 ;
USE `swinn` ;

-- -----------------------------------------------------
-- Table `swinn`.`module`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`module` ;

CREATE TABLE IF NOT EXISTS `swinn`.`module` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `iconfa` VARCHAR(100) NULL DEFAULT NULL,
  `label` VARCHAR(50) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `controller` VARCHAR(50) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `type_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_controller_type1_idx` (`type_id` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `swinn`.`profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`profile` ;

CREATE TABLE IF NOT EXISTS `swinn`.`profile` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `swinn`.`access`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`access` ;

CREATE TABLE IF NOT EXISTS `swinn`.`access` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `profile_id` INT(11) NOT NULL,
  `module_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_access_profile1_idx` (`profile_id` ASC),
  INDEX `fk_access_module1_idx` (`module_id` ASC),
  CONSTRAINT `fk_access_module1`
    FOREIGN KEY (`module_id`)
    REFERENCES `swinn`.`module` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_access_profile1`
    FOREIGN KEY (`profile_id`)
    REFERENCES `swinn`.`profile` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `swinn`.`ideas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`ideas` ;

CREATE TABLE IF NOT EXISTS `swinn`.`ideas` (
  `id` INT(11) NOT NULL,
  `ideadescription` VARCHAR(500) NOT NULL,
  `ideaorder` INT(11) NOT NULL,
  `ideaparent` INT(11) NOT NULL,
  `ideacreate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ideastart` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ideaend` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iconfa` VARCHAR(100) NULL DEFAULT NULL,
  `active` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `swinn`.`state`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`state` ;

CREATE TABLE IF NOT EXISTS `swinn`.`state` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `swinn`.`type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`type` ;

CREATE TABLE IF NOT EXISTS `swinn`.`type` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `swinn`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `swinn`.`user` ;

CREATE TABLE IF NOT EXISTS `swinn`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `names` VARCHAR(100) NOT NULL,
  `surnames` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `lastupdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type_id` INT(11) NOT NULL,
  `state_id` INT(11) NOT NULL,
  `sex` CHAR(1) NOT NULL,
  `profile_id` INT(11) NOT NULL,
  `authKey` VARCHAR(45) NULL DEFAULT NULL,
  `accessToken` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_tipo1_idx` (`type_id` ASC),
  INDEX `fk_usuario_estado1_idx` (`state_id` ASC),
  INDEX `fk_user_profile1_idx` (`profile_id` ASC),
  CONSTRAINT `fk_user_profile1`
    FOREIGN KEY (`profile_id`)
    REFERENCES `swinn`.`profile` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_estado1`
    FOREIGN KEY (`state_id`)
    REFERENCES `swinn`.`state` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo1`
    FOREIGN KEY (`type_id`)
    REFERENCES `swinn`.`type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
