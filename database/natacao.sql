CREATE DATABASE natacao;
USE natacao;
-- Criacao de tabelas fixas
CREATE TABLE tb_estado (
  IDESTADO INT PRIMARY KEY AUTO_INCREMENT,
  nomeEstado varchar(30) NOT NULL,
  siglaEstado char(2) NOT NULL
);
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
  nomeEstilo varchar(100) NOT NULL
);
CREATE TABLE tba_distancia_estilo (
  IDDISTANCIAESTILO INT PRIMARY KEY AUTO_INCREMENT,
  ID_DISTANCIA INT NOT NULL,
  ID_ESTILO INT NOT NULL
);
--
ALTER TABLE tba_distancia_estilo
ADD CONSTRAINT FK_ESTILO_DISTANCIA FOREIGN KEY(ID_ESTILO) REFERENCES tb_estilo(IDESTILO);
ALTER TABLE tba_distancia_estilo
ADD CONSTRAINT FK_DISTANCIA_ESTILO FOREIGN KEY(ID_DISTANCIA) REFERENCES tb_distancia(IDDISTANCIA);
-- Criacao de Tabelas 
CREATE TABLE tb_federacao (
  IDFEDERACAO INT PRIMARY KEY AUTO_INCREMENT,
  nomeFederacao varchar(100) NOT NULL,
  nomeFantasiaFederacao varchar(50),
  logoFederacao varchar(150),
  ID_ESTADO INT NOT NULL
);
-- 
ALTER TABLE tb_federacao
ADD CONSTRAINT FK_FEDERACAO_ESTADO FOREIGN KEY(ID_ESTADO) REFERENCES tb_estado(IDESTADO);
-- 
CREATE TABLE tb_equipe (
  IDEQUIPE INT PRIMARY KEY AUTO_INCREMENT,
  nomeEquipe varchar(100) NOT NULL,
  nomeFantasiaEquipe varchar(50),
  logoEquipe varchar(150),
  ID_FEDERACAO INT
);
-- 
ALTER TABLE tb_equipe
ADD CONSTRAINT FK_EQUIPE_FEDERACAO FOREIGN KEY(ID_FEDERACAO) REFERENCES tb_federacao(IDFEDERACAO);
-- 
CREATE TABLE tb_torneio (
  IDTORNEIO INT PRIMARY KEY AUTO_INCREMENT,
  nomeTorneio varchar(100) NOT NULL,
  dataTorneio DATE NOT NULL,
  -- ID_CIDADE INT,
  ID_PISCINA INT,
  ID_FEDERACAO INT
);
-- 
ALTER TABLE tb_torneio
ADD CONSTRAINT FK_TORNEIO_PISCINA FOREIGN KEY(ID_PISCINA) REFERENCES tb_piscina(IDPISCINA);
ALTER TABLE tb_torneio
ADD CONSTRAINT FK_TORNEIO_FEDERACAO FOREIGN KEY(ID_FEDERACAO) REFERENCES tb_federacao(IDFEDERACAO);
--
CREATE TABLE tb_prova (
IDPROVA INT PRIMARY KEY AUTO_INCREMENT,
numeroProva VARCHAR(5) NOT NULL,
genero ENUM('M', 'F') NOT NULL,
ID_TORNEIO INT,
ID_DISTANCIAESTILO INT,
-- ID_ESTILO INT,
-- ID_DISTANCIA INT,
ID_CATEGORIA_MIN INT,
ID_CATEGORIA_MAX INT
);
-- 
-- ALTER TABLE tb_prova
-- ADD CONSTRAINT FK_PROVA_DISTANCIAESTILO FOREIGN KEY(ID_DISTANCIAESTILO) REFERENCES tba_distancia_estilo(IDDISTANCIAESTILO);
ALTER TABLE tb_prova
ADD CONSTRAINT FK_PROVA_CATEGORIA_MIN FOREIGN KEY(ID_CATEGORIA_MIN) REFERENCES tb_categoria(IDCATEGORIA);
ALTER TABLE tb_prova
ADD CONSTRAINT FK_PROVA_CATEGORIA_MAX FOREIGN KEY(ID_CATEGORIA_MAX) REFERENCES tb_categoria(IDCATEGORIA);
ALTER TABLE tb_prova
ADD CONSTRAINT FK_PROVA_TORNEIO FOREIGN KEY(ID_TORNEIO) REFERENCES tb_torneio(IDTORNEIO);
-- 
CREATE TABLE tb_atleta (
  IDATLETA INT PRIMARY KEY AUTO_INCREMENT,
  nomeAtleta varchar(100) NOT NULL,
  sobreNomeAtleta varchar(30) NOT NULL,
  apelidoAtleta varchar(50) NOT NULL,
  emailAtleta varchar(100) NOT NULL,
  dataNascAtleta DATE NOT NULL,
  cpfAtleta VARCHAR(14) NOT NULL,
  numRegistroAtleta VARCHAR(10),
  sexoAtleta ENUM('M', 'F') NOT NULL,
  rgAtleta VARCHAR(12),
  ID_EQUIPE INT
);
CREATE TABLE tba_prova_atleta (
  IDPROVAATLETA INT PRIMARY KEY AUTO_INCREMENT,
  ID_PROVA INT,
  ID_ATLETA INT
);
--
ALTER TABLE tba_prova_atleta
ADD CONSTRAINT FK_PROVAATLETA_PROVA FOREIGN KEY(ID_PROVA) REFERENCES tb_prova(IDPROVA);
ALTER TABLE tba_prova_atleta
ADD CONSTRAINT FK_PROVAATLETA_ATLETA FOREIGN KEY(ID_ATLETA) REFERENCES tb_atleta(IDATLETA);
--
CREATE TABLE tb_indices (
IDINDICE INT PRIMARY KEY AUTO_INCREMENT,
anoIndice INT NOT NULL,
tempoIndice TIME(2) NOT NULL,
ID_CATEGORIA INT NOT NULL,
generoIndice ENUM('M', 'F') NOT NULL,
tipoIndice VARCHAR(30) NOT NULL,
ID_DISTANCIAESTILO INT NOT NULL,
ID_PISCINA INT NOT NULL
);
--
ALTER TABLE tb_indices
ADD CONSTRAINT FK_INDICE_PISCINA FOREIGN KEY(ID_PISCINA) REFERENCES tb_piscina(IDPISCINA);
ALTER TABLE tb_indices
ADD CONSTRAINT FK_INDICE_CATEGORIA FOREIGN KEY(ID_CATEGORIA) REFERENCES tb_categoria(IDCATEGORIA);
--
CREATE TABLE tb_tempoAtleta (
IDTMPATLETA INT PRIMARY KEY AUTO_INCREMENT,
tempoAtleta TIME(2) NOT NULL,
ID_PROVA INT NOT NULL,
ID_ATLETA INT NOT NULL
);
--
ALTER TABLE tb_tempoAtleta
ADD CONSTRAINT FK_TEMPOATLETA_PROVA FOREIGN KEY(ID_PROVA) REFERENCES tb_prova(IDPROVA);
ALTER TABLE tb_tempoAtleta
ADD CONSTRAINT FK_TEMPOATLETA_ATLETA FOREIGN KEY(ID_ATLETA) REFERENCES tb_atleta(IDATLETA);
--
CREATE TABLE tb_metaAtleta (
IDMETAATLETA INT PRIMARY KEY AUTO_INCREMENT,
tempoMetaAtleta TIME(2) NOT NULL,
ID_PISCINA INT NOT NULL,
ID_DISTANCIAESTILO INT NOT NULL,
ID_ATLETA INT NOT NULL
);
--
ALTER TABLE tb_metaAtleta
ADD CONSTRAINT FK_METAATLETA_ATLETA FOREIGN KEY(ID_ATLETA) REFERENCES tb_atleta(IDATLETA);
ALTER TABLE tb_metaAtleta
ADD CONSTRAINT FK_METAATLETA_PISCINA FOREIGN KEY(ID_PISCINA) REFERENCES tb_piscina(IDPISCINA);
--
-- Insercao de dados nas tabelas fixas
-- Tabla Estados
INSERT INTO tb_estado
VALUES(null, 'Acre', 'AC');
INSERT INTO tb_estado
VALUES(null, 'Amapa', 'AP');
INSERT INTO tb_estado
VALUES(null, 'Amazonas', 'AM');
INSERT INTO tb_estado
VALUES(null, 'Rondonia', 'RO');
INSERT INTO tb_estado
VALUES(null, 'Roraima', 'RR');
INSERT INTO tb_estado
VALUES(null, 'Para', 'PA');
INSERT INTO tb_estado
VALUES(null, 'Tocantins', 'TO');
INSERT INTO tb_estado
VALUES(null, 'Goias', 'GO');
INSERT INTO tb_estado
VALUES(null, 'Distrito Federal', 'DF');
INSERT INTO tb_estado
VALUES(null, 'Mato Grosso', 'MT');
INSERT INTO tb_estado
VALUES(null, 'Mato Grosso do Sul', 'MS');
INSERT INTO tb_estado
VALUES(null, 'Maranhão', 'MA');
INSERT INTO tb_estado
VALUES(null, 'Piaui', 'PI');
INSERT INTO tb_estado
VALUES(null, 'Ceara', 'CE');
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
VALUES(null, 'Paraiba', 'PB');
INSERT INTO tb_estado
VALUES(null, 'Espírito Santo', 'ES');
INSERT INTO tb_estado
VALUES(null, 'Minas Gerais', 'MG');
INSERT INTO tb_estado
VALUES(null, 'Rio de Janeiro', 'RJ');
INSERT INTO tb_estado
VALUES(null, 'São Paulo', 'SP');
INSERT INTO tb_estado
VALUES(null, 'Parana', 'PR');
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
-- Tabela Estilos
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
VALUES(7, 'Pre-Mirim', 7);
INSERT INTO tb_categoria
VALUES(8, 'Pre-Mirim', 8);
INSERT INTO tb_categoria
VALUES(9, 'Mirim 1', 9);
INSERT INTO tb_categoria
VALUES(10, 'Mirim 2', 10);
INSERT INTO tb_categoria
VALUES(11, 'Petiz 1', 11);
INSERT INTO tb_categoria
VALUES(12, 'Petiz 2', 12);
INSERT INTO tb_categoria
VALUES(13, 'Infantil 1', 13);
INSERT INTO tb_categoria
VALUES(14, 'Infantil 2', 14);
INSERT INTO tb_categoria
VALUES(15, 'Juvenil 1', 15);
INSERT INTO tb_categoria
VALUES(16, 'Juvenil 2', 16);
INSERT INTO tb_categoria
VALUES(17, 'Junior 1', 17);
INSERT INTO tb_categoria
VALUES(18, 'Junior 2', 18);
INSERT INTO tb_categoria
VALUES(99, 'Absoluto', 99);
-- Tabela TEste de dados
INSERT INTO tb_atleta
VALUES(
    null,
    'Fernando',
    'Fiad',
    'Mini-Tom',
    'fernando@gmail.com',
    '2016-03-13',
    '111.222.333-44',
    'FAP123456',
    'M',
    '99.888.777-6',
    null
  );
INSERT INTO tb_atleta
VALUES(
    null,
    'Antonio',
    'Fiad',
    'Tom',
    'tom@gmail.com',
    '2011-04-07',
    '555.666.777-88',
    '987654',
    'M',
    '11.222.333-4',
    null
  );
INSERT INTO tb_federacao
VALUES(
    null,
    'Federacao Aquatica Paulista',
    'FAP',
    null,
    24
  );
INSERT INTO tb_torneio
VALUES(
    null,
    '3o Torneio Regional Petz a Senior',
    '2024-05-18',
    1,
    1
  );
INSERT INTO tba_distancia_estilo
VALUES(null, 1, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 2, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 3, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 4, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 5, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 6, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 7, 1);
INSERT INTO tba_distancia_estilo
VALUES(null, 1, 2);
INSERT INTO tba_distancia_estilo
VALUES(null, 2, 2);
INSERT INTO tba_distancia_estilo
VALUES(null, 3, 2);
INSERT INTO tba_distancia_estilo
VALUES(null, 4, 2);
INSERT INTO tba_distancia_estilo
VALUES(null, 1, 3);
INSERT INTO tba_distancia_estilo
VALUES(null, 2, 3);
INSERT INTO tba_distancia_estilo
VALUES(null, 3, 3);
INSERT INTO tba_distancia_estilo
VALUES(null, 4, 3);
INSERT INTO tba_distancia_estilo
VALUES(null, 1, 4);
INSERT INTO tba_distancia_estilo
VALUES(null, 2, 4);
INSERT INTO tba_distancia_estilo
VALUES(null, 3, 4);
INSERT INTO tba_distancia_estilo
VALUES(null, 4, 4);
INSERT INTO tba_distancia_estilo
VALUES(null, 3, 5);
INSERT INTO tba_distancia_estilo
VALUES(null, 4, 5);
INSERT INTO tba_distancia_estilo
VALUES(null, 5, 5);
INSERT INTO tb_prova
VALUES(
    null,
    1,
    'M',
    1,
    5,
    13,
    99
  );
INSERT INTO tb_prova
VALUES(
    null,
    1,
    'F',
    1,
    5,
    13,
    99
  );
INSERT INTO tb_indices
VALUES(
    null,
    2024,
    '00:00:31.60',
    13,
    'F',
    'Brasileiro Inverno',
    1,
    2
  );
INSERT INTO tb_indices
VALUES(
    null,
    2024,
    '00:01:09.04',
    13,
    'F',
    'Brasileiro Inverno',
    2,
    2
  );
INSERT INTO tb_indices
VALUES(
    null,
    2024,
    '00:00:28.86',
    13,
    'M',
    'Brasileiro Inverno',
    1,
    2
  );
INSERT INTO tb_indices
VALUES(
    null,
    2024,
    '00:01:03.66',
    13,
    'M',
    'Brasileiro Inverno',
    2,
    2
  );
-- Querrys
-- SELECT nomeTorneio, f.nomeFantasiaFederacao, p.tamanhoPiscina 
-- FROM tb_torneio 
-- INNER JOIN tb_federacao as f ON ID_FEDERACAO = f.IDFEDERACAO 
-- INNER JOIN tb_piscina as p ON ID_PISCINA = p.IDPISCINA;
--
-- SELECT d.distancia, e.nomeEstilo 
-- FROM tba_distancia_estilo 
-- INNER JOIN tb_distancia AS d ON ID_DISTANCIA = d.IDDISTANCIA 
-- INNER JOIN tb_estilo AS e ON ID_ESTILO = e.IDESTILO;
--
-- SELECT anoIndice, tempoIndice, generoIndice, tipoIndice, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_indices
-- INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
-- INNER JOIN tb_distancia AS d ON 
-- (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
-- INNER JOIN tb_estilo AS e ON 
-- (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
-- INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA;
--
-- SELECT numeroProva, genero, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS "Categoria Minima", cmax.nomeCategoria AS "Categoria Maxima" FROM tb_prova
-- INNER JOIN tb_torneio AS t ON ID_TORNEIO = t.IDTORNEIO
-- INNER JOIN tb_distancia AS d ON 
-- (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_prova.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
-- INNER JOIN tb_estilo AS e ON 
-- (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_prova.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
-- INNER JOIN tb_piscina AS p ON t.ID_PISCINA = p.IDPISCINA
-- INNER JOIN tb_categoria AS cmin ON ID_CATEGORIA_MIN = cmin.IDCATEGORIA
-- INNER JOIN tb_categoria AS cmax ON ID_CATEGORIA_MAX = cmax.IDCATEGORIA;