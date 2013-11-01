CREATE SCHEMA IF NOT EXISTS `mvcdb` DEFAULT CHARACTER SET utf8 ;
USE `mvcdb` ;

DROP TABLE IF EXISTS `mvcdb`.`users` ;

CREATE  TABLE IF NOT EXISTS `mvcdb`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` CHAR(60) NULL DEFAULT NULL ,
  `salt` CHAR(10) NULL DEFAULT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `firstname` VARCHAR(45) NULL DEFAULT NULL ,
  `lastname` VARCHAR(45) NULL DEFAULT NULL ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `updated` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'User login will be implemented later, salt and password not ';

DROP TABLE IF EXISTS `mvcdb`.`pages` ;

CREATE  TABLE IF NOT EXISTS `mvcdb`.`pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  `slug` VARCHAR(255) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `updated` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`, `users_id`) ,
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) ,
  INDEX `fk_pages_users` (`users_id` ASC) ,
  CONSTRAINT `fk_pages_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `mvcdb`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE USER `mvc_user` IDENTIFIED BY 'test_user';

grant INSERT on TABLE `mvcdb`.`users` to mvc_user;
grant ALTER on TABLE `mvcdb`.`users` to mvc_user;
grant DELETE on TABLE `mvcdb`.`users` to mvc_user;
grant UPDATE on TABLE `mvcdb`.`users` to mvc_user;
grant SELECT on TABLE `mvcdb`.`users` to mvc_user;
grant ALTER on TABLE `mvcdb`.`pages` to mvc_user;
grant INSERT on TABLE `mvcdb`.`pages` to mvc_user;
grant DELETE on TABLE `mvcdb`.`pages` to mvc_user;
grant SELECT on TABLE `mvcdb`.`pages` to mvc_user;
grant UPDATE on TABLE `mvcdb`.`pages` to mvc_user;
