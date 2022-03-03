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
    `cursos_id` int(11) NOT NULL,
    `pessoa_fisicas_id` int(11) NOT NULL,
    `semestre` tinyint(5),	
    PRIMARY KEY (`cursos_id`,`pessoa_fisicas_id`),   
    KEY `fk_cursos_pessoas_idx`(`cursos_id`),
    KEY `fk_cursos_pessoas_pessoas_idx`(`pessoa_fisicas_id`),
    CONSTRAINT `fk_cursos_pessoas` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_cursos_pessoas_pessoas` FOREIGN KEY (`pessoa_fisicas_id`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    );

CREATE TABLE `log` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usuario_id` int(11) NOT NULL,
    `ip` varchar(15) NOT NULL,
    `data` datetime NOT NULL,
    `descricao` longtext NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `usuario`(
    `id` int primary key NOT NULL AUTO_INCREMENT,
    `nome` varchar(120) NOT NULL,
    `email` varchar(120) NOT NULL,
    `senha` varchar(60) NOT NULL,
    `telefone` varchar(15) NOT NULL,
    `publicado` tinyint(1) NOT NULL DEFAULT '1' 
    );

INSERT INTO `cursos` (`id`, `nome`, `duracao`, `publicado`) VALUES
	(1, 'Formação C# e orientação a objetos', 80, 1),
	(2, 'Kanban parte 1: Fundamentos Essenciais', 6, 1),
	(3, 'React: Entendendo como a biblioteca funciona', 12, 1),
	(4, 'Scrum: Agilidade em seu projeto', 10, 1),
	(5, 'Formação Engenharia de software', 90, 1),
	(6, 'Python 3: Trabalhando com I/O', 6, 1),
	(7, 'Formação Datomic', 60, 1),
	(8, 'Docker: Criando e gerenciando containers', 10, 1),
	(9, 'Nenhum', -1, 1);

INSERT INTO `pessoas` (`id`, `nome`, `email`, `data_nascimento`, `telefone`, `publicado`) VALUES
	(1, 'Pedro Henrique Carlos Gael Alves', 'pedro_henrique_alves@julietavinhas.fot.br', '1958-03-02', '(95) 3600-0461', 1),
	(2, 'Mariah Sophia Almeida', 'mariah-almeida79@sinelcom.com.br', '1974-03-01', '(43) 2841-6341', 1),
	(3, 'Gael Rafael Fábio Viana', 'gaelrafaelviana@hersa.com.br', '1956-02-05', '(67) 3738-5945', 1),
	(4, 'Márcia Raquel Lavínia Cavalcanti', 'marcia_raquel_cavalcanti@br.gestant.com', '1982-03-10', '(69) 2595-0179', 1);
	
INSERT INTO `cursos_pessoas` (`cursos_id`, `pessoa_fisicas_id`) VALUES
        (3, 1),
        (8, 2),
        (9, 3),
        (1, 4);  

INSERT INTO `usuario` (`id`, `nome`, `email, `senha`, `telefone`, `publicado`) VALUES
        (1, 'Teste', 'teste@teste.com', '123456', '(11) 9999-9999', 1);
 
