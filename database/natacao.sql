CREATE DATABASE natacao;
USE natacao;
-- Criacao de Tabelas 
CREATE TABLE tb_equipe (
  IDEQUIPE INT PRIMARY KEY AUTO_INCREMENT,
  nomeEquipe varchar(100) NOT NULL,
  nomeFantasiaEquipe varchar(50),
  logoEquipe varchar(150),
  ID_FEDERACAO INT
);
CREATE TABLE tb_prova (
  IDPROVA INT PRIMARY KEY AUTO_INCREMENT,
  numeroProva VARCHAR(5) NOT NULL,
  ID_TORNEIO INT,
  ID_ESTILO INT
);
CREATE TABLE tb_torneio (
  IDTORNEIO INT PRIMARY KEY AUTO_INCREMENT,
  nomeTorneio varchar(100) NOT NULL,
  dataTorneio DATE NOT NULL,
  ID_CIDADE INT,
  ID_PISCINA INT,
  ID_FEDERACAO INT
);
CREATE TABLE tb_atleta (
  IDATLETA INT PRIMARY KEY AUTO_INCREMENT,
  nomeAtleta varchar(100) NOT NULL,
  dataNascAtleta DATE NOT NULL,
  cpfAtleta VARCHAR(14) NOT NULL,
  numRegistroAtleta VARCHAR(10),
  sexoAtleta ENUM('M', 'F') NOT NULL,
  rgAtleta VARCHAR(12),
  ID_TORNEIO INT
);
CREATE TABLE tb_federacao (
  IDFEDERACAO INT PRIMARY KEY AUTO_INCREMENT,
  nomeFederacao varchar(100) NOT NULL,
  nomeFantasiaFederacao varchar(50),
  logoFederacao varchar(150),
  ID_ESTADO INT NOT NULL
);
CREATE TABLE tb_indices (
  IDINDICE INT PRIMARY KEY AUTO_INCREMENT,
  anoIndice INT NOT NULL,
  tempoIndice TIME(2) NOT NULL,
  ID_CATEGORIA INT NOT NULL,
  generoIndice ENUM('M', 'F') NOT NULL,
  tipoIndice VARCHAR(30) NOT NULL,
  ID_ESTILO INT NOT NULL,
  ID_PISCINA INT NOT NULL
);
CREATE TABLE tb_tempoAtleta (
  IDTMPATLETA INT PRIMARY KEY AUTO_INCREMENT,
  tempoAtleta TIME(2) NOT NULL,
  ID_PROVA INT NOT NULL,
  ID_ATLETA INT NOT NULL
);
CREATE TABLE tb_metaAtleta (
  IDMETAATLETA INT PRIMARY KEY AUTO_INCREMENT,
  tempoMetaAtleta TIME(2) NOT NULL,
  ID_TAMPISCINA INT NOT NULL,
  ID_ESTILO INT NOT NULL,
  ID_ATLETA INT NOT NULL
);
-- Criacao de tabelas fixas
CREATE TABLE tb_categoria (
  IDCATEGORIA INT PRIMARY KEY AUTO_INCREMENT,
  nomeCategoria varchar(100) NOT NULL,
  idadeCategoria INT
);
CREATE TABLE tb_piscina (
  IDPISCINA INT PRIMARY KEY AUTO_INCREMENT,
  tamanhoPiscina INT NOT NULL
);
CREATE TABLE tb_distancia (
  IDDISTANCIA INT PRIMARY KEY AUTO_INCREMENT,
  distancia INT NOT NULL
);
CREATE TABLE tb_estilo (
  IDESTILO INT PRIMARY KEY AUTO_INCREMENT,
  nomeEstilo varchar(100) NOT NULL,
  ID_DISTANCIA INT NOT NULL
);
CREATE TABLE tb_estado (
  IDESTADO INT PRIMARY KEY AUTO_INCREMENT,
  nomeEstado varchar(30) NOT NULL,
  siglaEstado char(2) NOT NULL
);
-- Insercao de dados nas tabelas fixas
-- Tabla Estados
INSERT INTO tb_estado
VALUES(null, 'Acre', 'AC');
INSERT INTO tb_estado
VALUES(null, 'Amapá', 'AP');
INSERT INTO tb_estado
VALUES(null, 'Amazonas', 'AM');
INSERT INTO tb_estado
VALUES(null, 'Rondônia', 'RO');
INSERT INTO tb_estado
VALUES(null, 'Roraima', 'RR');
INSERT INTO tb_estado
VALUES(null, 'Pará', 'PA');
INSERT INTO tb_estado
VALUES(null, 'Tocantins', 'TO');
INSERT INTO tb_estado
VALUES(null, 'Goiás', 'GO');
INSERT INTO tb_estado
VALUES(null, 'Distrito Federal', 'DF');
INSERT INTO tb_estado
VALUES(null, 'Mato Grosso', 'MT');
INSERT INTO tb_estado
VALUES(null, 'Mato Grosso do Sul', 'MS');
INSERT INTO tb_estado
VALUES(null, 'Maranhão', 'MA');
INSERT INTO tb_estado
VALUES(null, 'Piauí', 'PI');
INSERT INTO tb_estado
VALUES(null, 'Ceará', 'CE');
INSERT INTO tb_estado
VALUES(null, 'Rio Grande do Norte', 'RN');
INSERT INTO tb_estado
VALUES(null, 'Pernambuco', 'PE');
INSERT INTO tb_estado
VALUES(null, 'Alagoas', 'AL');
INSERT INTO tb_estado
VALUES(null, 'Sergipe', 'SE');
INSERT INTO tb_estado
VALUES(null, 'Bahia', 'BA');
INSERT INTO tb_estado
VALUES(null, 'Paraíba', 'PB');
INSERT INTO tb_estado
VALUES(null, 'Espírito Santo', 'ES');
INSERT INTO tb_estado
VALUES(null, 'Minas Gerais', 'MG');
INSERT INTO tb_estado
VALUES(null, 'Rio de Janeiro', 'RJ');
INSERT INTO tb_estado
VALUES(null, 'São Paulo', 'SP');
INSERT INTO tb_estado
VALUES(null, 'Paraná', 'PR');
INSERT INTO tb_estado
VALUES(null, 'Santa Catarina', 'SC');
INSERT INTO tb_estado
VALUES(null, 'Rio Grande do Sul', 'RS');
-- Tabela tamanho piscina
INSERT INTO tb_piscina
VALUES(null, 25);
INSERT INTO tb_piscina
VALUES(null, 50);
INSERT INTO tb_piscina
VALUES(null, 00);
.-- Tabela Estilos
INSERT INTO tb_estilo
VALUES(null, 'Livre');
INSERT INTO tb_estilo
VALUES(null, 'Borboleta');
INSERT INTO tb_estilo
VALUES(null, 'Costas');
INSERT INTO tb_estilo
VALUES(null, 'Peito');
INSERT INTO tb_estilo
VALUES(null, 'Medley');
-- Tabela Distancias Provas
INSERT INTO tb_distancia
VALUES(null, 25);
INSERT INTO tb_distancia
VALUES(null, 50);
INSERT INTO tb_distancia
VALUES(null, 100);
INSERT INTO tb_distancia
VALUES(null, 200);
INSERT INTO tb_distancia
VALUES(null, 400);
INSERT INTO tb_distancia
VALUES(null, 800);
INSERT INTO tb_distancia
VALUES(null, 1500);
-- Tabela Categorias
INSERT INTO tb_categoria
VALUES(null, 'Pre-Mirim', 7);
INSERT INTO tb_categoria
VALUES(null, 'Pre-Mirim', 8);
INSERT INTO tb_categoria
VALUES(null, 'Mirim 1', 9);
INSERT INTO tb_categoria
VALUES(null, 'Mirim 2', 10);
INSERT INTO tb_categoria
VALUES(null, 'Petiz 1', 11);
INSERT INTO tb_categoria
VALUES(null, 'Petiz 1', 11);
INSERT INTO tb_categoria
VALUES(null, 'Adulto', 99);