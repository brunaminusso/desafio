create database CURSO;

use curso;

create table cursos(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NOME VARCHAR(45) NOT NULL,
    DURACAO INT,
    PUBLICADO tinyint(1) NOT NULL
    );

CREATE TABLE PESSOAS(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NOME VARCHAR(120) NOT NULL,
    EMAIL VARCHAR(120) NOT NULL,
    data_nascimento DATE NOT NULL,
    TELEFONE VARCHAR(15) NOT NULL,
    PUBLICADO tinyint(1) NOT NULL    
    );

CREATE TABLE CURSOS_PESSOAS(
    CURSOS_ID INT,
    PESSOA_FISICAS_ID INT NOT NULL,
    SEMESTRE tinyint(5) NOT NULL,	
    FOREIGN KEY(CURSOS_ID) REFERENCES CURSOS(ID),
    FOREIGN KEY(PESSOA_FISICAS_ID) REFERENCES PESSOAS(ID)
    );

CREATE TABLE USUARIO(
    ID INT PRIMARY KEY,
    NOME VARCHAR(120) NOT NULL,
    EMAIL VARCHAR(120) NOT NULL
    SENHA VARCHAR(60) NOT NULL,
    TELEFONE VARCHAR(15) NOT NULL,
    PUBLICADO tinyint(1) NOT NULL    
    );