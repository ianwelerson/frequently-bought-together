-- MySQL Script generated by MySQL Workbench
-- Wed Nov  8 21:46:46 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema study_fbt
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema study_fbt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `study_fbt` DEFAULT CHARACTER SET utf8 ;
USE `study_fbt` ;

-- -----------------------------------------------------
-- Table `study_fbt`.`fbt_products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `study_fbt`.`fbt_products` ;

CREATE TABLE IF NOT EXISTS `study_fbt`.`fbt_products` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `product_name` TEXT(255) NOT NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `study_fbt`.`fbt_lists`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `study_fbt`.`fbt_lists` ;

CREATE TABLE IF NOT EXISTS `study_fbt`.`fbt_lists` (
  `list_id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`list_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `study_fbt`.`fbt_product_list`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `study_fbt`.`fbt_product_list` ;

CREATE TABLE IF NOT EXISTS `study_fbt`.`fbt_product_list` (
  `fbt_lists_list_id` INT NOT NULL,
  `fbt_products_product_id` INT NOT NULL,
  INDEX `fk_fbt_product_list_fbt_lists_idx` (`fbt_lists_list_id` ASC),
  INDEX `fk_fbt_product_list_fbt_products1_idx` (`fbt_products_product_id` ASC),
  PRIMARY KEY (`fbt_lists_list_id`, `fbt_products_product_id`),
  CONSTRAINT `fk_fbt_product_list_fbt_lists`
    FOREIGN KEY (`fbt_lists_list_id`)
    REFERENCES `study_fbt`.`fbt_lists` (`list_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fbt_product_list_fbt_products1`
    FOREIGN KEY (`fbt_products_product_id`)
    REFERENCES `study_fbt`.`fbt_products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
