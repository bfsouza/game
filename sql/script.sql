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
  `id`                  int(8)          AUTO_INCREMENT,
  `id_time`             int(8)          DEFAULT NULL,
  `nome`                varchar(500)    DEFAULT NULL,
  `idade`               int(5)        DEFAULT NULL,
  `experienca`          int(5)        DEFAULT NULL,
  `numero`              int(5)        DEFAULT NULL,
  `goleiro`             int(5)        DEFAULT NULL,
  `defesa`              int(5)        DEFAULT NULL,
  `armacao`             int(5)        DEFAULT NULL,
  `ala`                 int(5)        DEFAULT NULL,
  `atacante`            int(5)        DEFAULT NULL,
  `bola_parada`         int(5)        DEFAULT NULL,
  `gol`                 int(5)        DEFAULT NULL,
  `qtd_cartao_amarelo`  int(5)        DEFAULT NULL, 
  `qtd_cartao_vermelho` int(5)        DEFAULT NULL, 
  `data_cadastro`       datetime      DEFAULT NULL,
  `ativo`               int(1)        DEFAULT 1,
  PRIMARY KEY (`id`)
);

/*
 * Caixa
 */
DROP TABLE IF EXISTS `game`.`caixa`;
CREATE TABLE  `game`.`caixa` (
  `id`               int(8)          AUTO_INCREMENT,
  `id_time`          int(8)          DEFAULT NULL,
  `valor`            float(8,2)      DEFAULT NULL,  
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
  `valor`      float(8,2)      DEFAULT NULL,  
  PRIMARY KEY (`id`)
);

/*
 * Departamento Médico
 */
DROP TABLE IF EXISTS `game`.`departamento_medico`;
CREATE TABLE  `game`.`departamento_medico` (
  `id`                  int(8)          AUTO_INCREMENT,
  `id_jogador`          int(8)          DEFAULT NULL,
  `lesao`               varchar(100)    DEFAULT NULL,  
  `tempo_recuperacao`   int(8)          DEFAULT NULL,  
  `data_entrada`        datetime        DEFAULT NULL,  
  PRIMARY KEY (`id`)
);

/*
 * Estádio
 */
DROP TABLE IF EXISTS `game`.`estadio`;
CREATE TABLE  `game`.`estadio` (
  `id`                       int(8)       AUTO_INCREMENT,
  `id_time`                  int(8)       DEFAULT NULL,
  `capacidade_geral`         int(8)       DEFAULT NULL,  
  `capacidade_arquibancada`  int(8)       DEFAULT NULL,  
  `capacidade_cadeira`       int(8)       DEFAULT NULL,  
  `capacidade_camarote`      int(8)       DEFAULT NULL,  
  `valor_geral`              float(8,2)   DEFAULT NULL,  
  `valor_arquibancada`       float(8,2)   DEFAULT NULL,  
  `valor_cadeira`            float(8,2)   DEFAULT NULL,  
  `valor_camarote`           float(8,2)   DEFAULT NULL,  
  PRIMARY KEY (`id`)
);

/*
 * Reforma Estádio
 */
DROP TABLE IF EXISTS `game`.`reforma_estadio`;
CREATE TABLE  `game`.`reforma_estadio` (
  `id`                   int(8)       AUTO_INCREMENT,
  `id_estadio`           int(8)       DEFAULT NULL,
  `qtd_geral`            int(8)       DEFAULT NULL,  
  `qtd_arquibancada`     int(8)       DEFAULT NULL,  
  `qtd_cadeira`          int(8)       DEFAULT NULL,  
  `qtd_camarote`         int(8)       DEFAULT NULL,  
  `valor_total_reforma`  float(8,2)   DEFAULT NULL, 
  `data_inicio`          datetime     DEFAULT NULL,  
  `data_fim`             datetime     DEFAULT NULL,  
  PRIMARY KEY (`id`)
);

/*
 * Transferência
 */
DROP TABLE IF EXISTS `game`.`transferencia`;
CREATE TABLE  `game`.`transferencia` (
  `id`                    int(8)          AUTO_INCREMENT,
  `id_time_origem`        int(8)          DEFAULT NULL,
  `id_time_destino`       int(8)          DEFAULT NULL,
  `data_transferencia`    datetime        DEFAULT NULL,  
  `valor_transferencia`   float(10,2)     DEFAULT NULL,  
  PRIMARY KEY (`id`)
);