CREATE DATABASE topicos;

USE topicos;

CREATE TABLE `topicos`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `cpf` VARCHAR(20) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));

#INSERT into user (name, username, password, created_at) values ('claudinho', md5('claudinho'));