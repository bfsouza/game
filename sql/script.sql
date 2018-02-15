DROP DATABASE `game`;
CREATE DATABASE `game`;

/*
 * Time
 */
DROP TABLE IF EXISTS `game`.`time`;
CREATE TABLE  `game`.`time` (
  `id`                  int(8)          AUTO_INCREMENT,
  `id_usuario`          int(8)          DEFAULT NULL,
  `nome`                varchar(100)    DEFAULT NULL,
  `pais`                varchar(100)    DEFAULT NULL,
  `experiencia`         int(3)          DEFAULT 0,  
  `ativo`               int(1)          DEFAULT 1,
  PRIMARY KEY (`id`)
);

/*
 * Jogador
 */
DROP TABLE IF EXISTS `game`.`jogador`;
CREATE TABLE  `game`.`jogador` (
  `id`                int(8)          AUTO_INCREMENT,
  `id_time`           int(8)          DEFAULT NULL,
  `nome`              varchar(500)    DEFAULT NULL,
  `idade`             varchar(500)    DEFAULT NULL,
  `experienca`        int(999)        DEFAULT NULL,
  `goleiro`           int(999)        DEFAULT NULL,
  `defesa`            int(999)        DEFAULT NULL,
  `armacao`           int(999)        DEFAULT NULL,
  `ala`               int(999)        DEFAULT NULL,
  `atacante`          int(999)        DEFAULT NULL,
  `bola_parada`       int(999)        DEFAULT NULL,
  `gol`               int(1)          DEFAULT NULL,
  `cartao_amarelo`    varchar(1000)   DEFAULT NULL, 
  `cartao_vermelho`   varchar(1000)   DEFAULT NULL, 
  `data_cadastro`     datetime        DEFAULT NULL,
  `ativo`             int(1)          DEFAULT 1,
  PRIMARY KEY (`id`)
);

/*
 * Caixa
 */
DROP TABLE IF EXISTS `game`.`caixa`;
CREATE TABLE  `game`.`caixa` (
  `id`               int(8)          AUTO_INCREMENT,
  `id_time`          int(8)          DEFAULT NULL,
  `valor`            varchar(100)    DEFAULT NULL,  
  PRIMARY KEY (`id`)
);

/*
 * Caixa - Lançamento
 */
DROP TABLE IF EXISTS `game`.`lancamento_caixa`;
CREATE TABLE  `game`.`lancamento_caixa` (
  `id`         int(8)          AUTO_INCREMENT,
  `id_caixa`   int(8)          DEFAULT NULL,
  `descricao`  varchar(100)    DEFAULT NULL,  
  `valor`      varchar(100)    DEFAULT NULL,  
  PRIMARY KEY (`id`)
);