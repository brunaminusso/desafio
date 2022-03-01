CREATE DATABASE `curso`;

USE `curso`;

CREATE TABLE `cursos`(
    `id` int primary key NOT NULL AUTO_INCREMENT,
    `nome` varchar(45) NOT NULL,
    `duracao` int,
    `publicado` tinyint(1) NOT NULL DEFAULT '1'
    );

CREATE TABLE `pessoas`(
    `id` int primary key NOT NULL AUTO_INCREMENT,
    `nome` varchar(120) NOT NULL,
    `email` varchar(120) NOT NULL,
    `data_nascimento` date NOT NULL,
    `telefone` varchar(15) NOT NULL,
    `publicado` tinyint(1) NOT NULL DEFAULT '1'    
    );

CREATE TABLE `cursos_pessoas`(
    `cursos_id` int,
    `pessoa_fisicas_id` int NOT NULL,
    `semestre` tinyint(5),	
    FOREIGN KEY(`cursos_id`) REFERENCES `cursos`(`id`),
    FOREIGN KEY(`pessoa_fisicas_id`) REFERENCES `pessoas`(`id`)
    );

CREATE TABLE `usuario`(
    `id` int primary key NOT NULL AUTO_INCREMENT,
    `nome` varchar(120) NOT NULL,
    `email` varchar(120) NOT NULL,
    `senha` varchar(60) NOT NULL,
    `telefone` varchar(15) NOT NULL,
    `publicado` tinyint(1) NOT NULL DEFAULT '1' 
    );

