-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: natacao
-- ------------------------------------------------------
-- Server version	8.4.1
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Table structure for table `tb_atleta`
--
DROP TABLE IF EXISTS `tb_atleta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_atleta` (
    `IDATLETA` int NOT NULL AUTO_INCREMENT,
    `nomeAtleta` varchar(100) NOT NULL,
    `sobreNomeAtleta` varchar(30) NOT NULL,
    `apelidoAtleta` varchar(50) DEFAULT NULL,
    `emailAtleta` varchar(100) NOT NULL,
    `dataNascAtleta` date NOT NULL,
    `cpfAtleta` varchar(14) NOT NULL,
    `numRegistroAtleta` varchar(10) DEFAULT NULL,
    `sexoAtleta` enum('M', 'F') NOT NULL,
    `rgAtleta` varchar(12) DEFAULT NULL,
    `fotoAtleta` varchar(150) DEFAULT NULL,
    `instagramAtleta` varchar(100) DEFAULT NULL,
    `facebookAtleta` varchar(100) DEFAULT NULL,
    `telefoneAtleta` varchar(20) DEFAULT NULL,
    `whatsappAtleta` varchar(20) DEFAULT NULL,
    `ID_EQUIPE` int DEFAULT NULL,
    PRIMARY KEY (`IDATLETA`),
    KEY `FK_ATLETA_EQUIPE` (`ID_EQUIPE`),
    CONSTRAINT `FK_ATLETA_EQUIPE` FOREIGN KEY (`ID_EQUIPE`) REFERENCES `tb_equipe` (`IDEQUIPE`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_atleta`
--
LOCK TABLES `tb_atleta` WRITE;
/*!40000 ALTER TABLE `tb_atleta` DISABLE KEYS */
;
INSERT INTO `tb_atleta`
VALUES (
        1,
        'Fernando',
        'Fiad',
        'Mini-Tom',
        'fernando@gmail.com',
        '2016-03-13',
        '111.222.333-44',
        'FAP123456',
        'M',
        '99.888.777-6',
        './images/fotos/foto_1_Fiad_2016-03-13.jpg',
        '',
        '',
        '',
        '',
        2
    ),
    (
        2,
        'Antonio',
        'Fiad',
        'Tom',
        'tom@gmail.com',
        '2011-04-07',
        '555.666.777-88',
        '987654',
        'M',
        '11.222.333-4',
        './images/fotos/foto_2_Fiad_2011-04-07.jpg',
        '',
        '',
        '',
        '',
        2
    ),
    (
        4,
        'João',
        'Nadador',
        'JN',
        'joaonadador@gmail.com',
        '1985-05-19',
        '755.498.532-99',
        '',
        'M',
        '',
        './images/fotos/foto_João_Nadador_1985-05-19.png',
        '',
        '',
        '',
        '',
        1
    ),
    (
        6,
        'Andreza',
        'Pereira',
        'DEDE',
        'andrezazaninete83@gmail.com',
        '1980-05-27',
        '284.218.218-90',
        '',
        'F',
        '297926378',
        './images/fotos/foto_Andreza_Pereira_1980-05-27.png',
        '',
        '',
        '11996200765',
        '11996200765',
        4
    ),
    (
        7,
        'Jose',
        'Silva',
        'Jose',
        'jose@gmail.com',
        '2009-12-15',
        '678.908.129-14',
        '778899',
        'M',
        '9988855544',
        './images/fotos/foto_Jose_Silva_2015-12-15.png',
        '',
        '',
        '',
        '',
        4
    );
/*!40000 ALTER TABLE `tb_atleta` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_atleta_bio`
--
DROP TABLE IF EXISTS `tb_atleta_bio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_atleta_bio` (
    `IDATLETABIO` int NOT NULL AUTO_INCREMENT,
    `ID_ATLETA` int NOT NULL,
    `dataDadosBiologicos` date NOT NULL,
    `pesoAtleta` float NOT NULL,
    `alturaAtleta` float NOT NULL,
    `envergaduraAtleta` float NOT NULL,
    `observacaoBiologicaAtleta` text,
    PRIMARY KEY (`IDATLETABIO`),
    KEY `FK_ATLETABIO_ATLETA` (`ID_ATLETA`),
    CONSTRAINT `FK_ATLETABIO_ATLETA` FOREIGN KEY (`ID_ATLETA`) REFERENCES `tb_atleta` (`IDATLETA`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_atleta_bio`
--
LOCK TABLES `tb_atleta_bio` WRITE;
/*!40000 ALTER TABLE `tb_atleta_bio` DISABLE KEYS */
;
/*!40000 ALTER TABLE `tb_atleta_bio` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_categoria`
--
DROP TABLE IF EXISTS `tb_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_categoria` (
    `IDCATEGORIA` int NOT NULL AUTO_INCREMENT,
    `nomeCategoria` varchar(100) NOT NULL,
    `idadeCategoria` int DEFAULT NULL,
    PRIMARY KEY (`IDCATEGORIA`)
) ENGINE = InnoDB AUTO_INCREMENT = 100 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_categoria`
--
LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */
;
INSERT INTO `tb_categoria`
VALUES (7, 'Pre-Mirim', 7),
    (8, 'Pre-Mirim', 8),
    (9, 'Mirim 1', 9),
    (10, 'Mirim 2', 10),
    (11, 'Petiz 1', 11),
    (12, 'Petiz 2', 12),
    (13, 'Infantil 1', 13),
    (14, 'Infantil 2', 14),
    (15, 'Juvenil 1', 15),
    (16, 'Juvenil 2', 16),
    (17, 'Junior 1', 17),
    (18, 'Junior 2', 18),
    (99, 'Senior', 99);
/*!40000 ALTER TABLE `tb_categoria` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_complexo`
--
DROP TABLE IF EXISTS `tb_complexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_complexo` (
    `IDCOMPLEXO` int NOT NULL AUTO_INCREMENT,
    `nomeComplexo` varchar(100) NOT NULL,
    `nomeFantasiaComplexo` varchar(50) NOT NULL,
    `fotoComplexo` varchar(150) DEFAULT NULL,
    `enderecoComplexo` varchar(100) DEFAULT NULL,
    `bairroComplexo` varchar(100) DEFAULT NULL,
    `cepComplexo` varchar(20) DEFAULT NULL,
    `cidadeComplexo` varchar(100) DEFAULT NULL,
    `latitudeComplexo` float DEFAULT NULL,
    `longitudeComplexo` float DEFAULT NULL,
    `observacaoComplexo` text,
    `ID_ESTADO` int DEFAULT NULL,
    PRIMARY KEY (`IDCOMPLEXO`),
    KEY `FK_COMPLEXO_ESTADO` (`ID_ESTADO`),
    CONSTRAINT `FK_COMPLEXO_ESTADO` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tb_estado` (`IDESTADO`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_complexo`
--
LOCK TABLES `tb_complexo` WRITE;
/*!40000 ALTER TABLE `tb_complexo` DISABLE KEYS */
;
INSERT INTO `tb_complexo`
VALUES (
        1,
        'Complexo Esportivo Lauro Gomes de Almeida',
        'Conjunto Aquatico Leonardo Sperate',
        './images/fotos/piscina_ConjuntoAquaticoLeonardoSperate.jpg',
        'Rua Walter Thome, 64',
        'Bairro Olimpico',
        NULL,
        'Sao Caetano do Sul',
        NULL,
        NULL,
        NULL,
        24
    ),
    (
        2,
        'Complexo Esportivo Pedro Dell Antonia',
        'Complexo Esportivo Pedro Dell Antonia',
        './images/fotos/piscina_ComplexoEsportivoPedroDellAntonia.jpg',
        'Rua Sao Pedro, 27',
        'Silveira',
        NULL,
        'Santo Andre',
        NULL,
        NULL,
        NULL,
        24
    ),
    (
        3,
        'Nova Piscina Olimpica da Bahia',
        'Nova Piscina Olimpica da Bahia',
        './images/fotos/piscina_NovaPiscinaOlimpicadaBahia.jpg',
        'Av Mario Leal Ferreira',
        'Brotas',
        NULL,
        'Salvador',
        NULL,
        NULL,
        NULL,
        19
    ),
    (
        4,
        'Sport Clube Corinthians Paulista',
        'Corinthians',
        './images/fotos/piscina_Corinthians.jpg',
        'Rua São Jorge, 777',
        '',
        NULL,
        'São Paulo',
        NULL,
        NULL,
        '',
        24
    ),
    (
        5,
        'Parque Aquático Carlos A. Biazzoto',
        'Carlos Biazzoto',
        './images/fotos/piscina_CarlosBiazzoto.gif',
        'Rua Fernando Simonsen, 130',
        'Cerâmica',
        NULL,
        'São Caetano do Sul',
        NULL,
        NULL,
        '',
        24
    );
/*!40000 ALTER TABLE `tb_complexo` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_distancia`
--
DROP TABLE IF EXISTS `tb_distancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_distancia` (
    `IDDISTANCIA` int NOT NULL AUTO_INCREMENT,
    `distancia` int NOT NULL,
    PRIMARY KEY (`IDDISTANCIA`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_distancia`
--
LOCK TABLES `tb_distancia` WRITE;
/*!40000 ALTER TABLE `tb_distancia` DISABLE KEYS */
;
INSERT INTO `tb_distancia`
VALUES (1, 25),
    (2, 50),
    (3, 100),
    (4, 200),
    (5, 400),
    (6, 800),
    (7, 1500);
/*!40000 ALTER TABLE `tb_distancia` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_equipe`
--
DROP TABLE IF EXISTS `tb_equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_equipe` (
    `IDEQUIPE` int NOT NULL AUTO_INCREMENT,
    `nomeEquipe` varchar(100) NOT NULL,
    `nomeFantasiaEquipe` varchar(50) DEFAULT NULL,
    `logoEquipe` varchar(150) DEFAULT NULL,
    `siteEquipe` varchar(100) DEFAULT NULL,
    `emailEquipe` varchar(100) DEFAULT NULL,
    `telefoneEquipe` varchar(20) DEFAULT NULL,
    `facebookEquipe` varchar(100) DEFAULT NULL,
    `instagramEquipe` varchar(100) DEFAULT NULL,
    `ID_FEDERACAO` int DEFAULT NULL,
    PRIMARY KEY (`IDEQUIPE`),
    KEY `FK_EQUIPE_FEDERACAO` (`ID_FEDERACAO`),
    CONSTRAINT `FK_EQUIPE_FEDERACAO` FOREIGN KEY (`ID_FEDERACAO`) REFERENCES `tb_federacao` (`IDFEDERACAO`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_equipe`
--
LOCK TABLES `tb_equipe` WRITE;
/*!40000 ALTER TABLE `tb_equipe` DISABLE KEYS */
;
INSERT INTO `tb_equipe`
VALUES (
        1,
        'Sem equipe',
        'Sem equipe',
        './images/logos/logoSemequipe.png',
        '',
        '',
        '',
        '',
        '',
        1
    ),
    (
        2,
        'Associação Atletica Sao Caetano',
        'Natação São Caetano',
        './images/logos/logoSaoCaetano.png',
        '',
        '',
        '(11) 95854 - 8755 ',
        '',
        '@serc',
        2
    ),
    (
        3,
        'Primeiro de Maio Futebol Clube',
        'Natacao Santo Andre',
        './images/logos/logoSAndre.png',
        '',
        '',
        '',
        '',
        '',
        2
    ),
    (
        4,
        'Serviço Social da Indústria de São Paulo',
        'SESI-SP',
        './images/logos/logoSESI-SP.jpg',
        '',
        '',
        '',
        '',
        '',
        2
    );
/*!40000 ALTER TABLE `tb_equipe` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_estado`
--
DROP TABLE IF EXISTS `tb_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_estado` (
    `IDESTADO` int NOT NULL AUTO_INCREMENT,
    `nomeEstado` varchar(30) NOT NULL,
    `siglaEstado` char(2) NOT NULL,
    PRIMARY KEY (`IDESTADO`)
) ENGINE = InnoDB AUTO_INCREMENT = 28 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_estado`
--
LOCK TABLES `tb_estado` WRITE;
/*!40000 ALTER TABLE `tb_estado` DISABLE KEYS */
;
INSERT INTO `tb_estado`
VALUES (1, 'Acre', 'AC'),
    (2, 'Amapa', 'AP'),
    (3, 'Amazonas', 'AM'),
    (4, 'Rondonia', 'RO'),
    (5, 'Roraima', 'RR'),
    (6, 'Para', 'PA'),
    (7, 'Tocantins', 'TO'),
    (8, 'Goias', 'GO'),
    (9, 'Distrito Federal', 'DF'),
    (10, 'Mato Grosso', 'MT'),
    (11, 'Mato Grosso do Sul', 'MS'),
    (12, 'MaranhÃ£o', 'MA'),
    (13, 'Piaui', 'PI'),
    (14, 'Ceara', 'CE'),
    (15, 'Rio Grande do Norte', 'RN'),
    (16, 'Pernambuco', 'PE'),
    (17, 'Alagoas', 'AL'),
    (18, 'Sergipe', 'SE'),
    (19, 'Bahia', 'BA'),
    (20, 'Paraiba', 'PB'),
    (21, 'Espirito Santo', 'ES'),
    (22, 'Minas Gerais', 'MG'),
    (23, 'Rio de Janeiro', 'RJ'),
    (24, 'Sao Paulo', 'SP'),
    (25, 'Parana', 'PR'),
    (26, 'Santa Catarina', 'SC'),
    (27, 'Rio Grande do Sul', 'RS');
/*!40000 ALTER TABLE `tb_estado` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_estilo`
--
DROP TABLE IF EXISTS `tb_estilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_estilo` (
    `IDESTILO` int NOT NULL AUTO_INCREMENT,
    `nomeEstilo` varchar(100) NOT NULL,
    PRIMARY KEY (`IDESTILO`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_estilo`
--
LOCK TABLES `tb_estilo` WRITE;
/*!40000 ALTER TABLE `tb_estilo` DISABLE KEYS */
;
INSERT INTO `tb_estilo`
VALUES (1, 'Livre'),
    (2, 'Borboleta'),
    (3, 'Costas'),
    (4, 'Peito'),
    (5, 'Medley');
/*!40000 ALTER TABLE `tb_estilo` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_federacao`
--
DROP TABLE IF EXISTS `tb_federacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_federacao` (
    `IDFEDERACAO` int NOT NULL AUTO_INCREMENT,
    `nomeFederacao` varchar(100) NOT NULL,
    `nomeFantasiaFederacao` varchar(50) DEFAULT NULL,
    `logoFederacao` varchar(150) DEFAULT NULL,
    `siteFederacao` varchar(100) DEFAULT NULL,
    `emailFederacao` varchar(100) DEFAULT NULL,
    `telefoneFederacao` varchar(20) DEFAULT NULL,
    `facebookFederacao` varchar(100) DEFAULT NULL,
    `instagramFederacao` varchar(100) DEFAULT NULL,
    `ID_ESTADO` int NOT NULL,
    PRIMARY KEY (`IDFEDERACAO`),
    KEY `FK_FEDERACAO_ESTADO` (`ID_ESTADO`),
    CONSTRAINT `FK_FEDERACAO_ESTADO` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tb_estado` (`IDESTADO`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_federacao`
--
LOCK TABLES `tb_federacao` WRITE;
/*!40000 ALTER TABLE `tb_federacao` DISABLE KEYS */
;
INSERT INTO `tb_federacao`
VALUES (
        1,
        'Confederacao Brasileira de Desportos Aquaticos',
        'CBDA',
        './images/logos/logoCBDA.png',
        'https://www.cbda.org.br/',
        '',
        '',
        '',
        '',
        24
    ),
    (
        2,
        'Federacao Aquatica Paulista',
        'FAP',
        './images/logos/logoFAP.png',
        'https://www.aquaticapaulista.org.br/',
        '',
        '',
        '',
        '',
        24
    ),
    (
        3,
        'Federacao Aquatica do Rio de Janeiro',
        'FARJ',
        './images/logos/logoFARJ.png',
        'https://aquatica.org.br/',
        '',
        '',
        '',
        '',
        23
    ),
    (
        4,
        'Federacao Aquatica Mineira',
        'FAM',
        './images/logos/logoFAM.png',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        22
    ),
    (
        5,
        'Federacao Aquatica Capixaba',
        'FAC',
        './images/logos/logoFAC.png',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        21
    ),
    (
        6,
        'Federação de Desportos Aquáticos do Paraná',
        'FDAP',
        './images/logos/logoFDAP.png',
        'https://fdap.org.br/',
        '',
        '',
        '',
        '',
        25
    );
/*!40000 ALTER TABLE `tb_federacao` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_indices`
--
DROP TABLE IF EXISTS `tb_indices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_indices` (
    `IDINDICE` int NOT NULL AUTO_INCREMENT,
    `anoIndice` int NOT NULL,
    `tempoIndice` time(2) NOT NULL,
    `ID_CATEGORIA` int NOT NULL,
    `generoIndice` enum('M', 'F') NOT NULL,
    `tipoIndice` varchar(30) NOT NULL,
    `ID_DISTANCIAESTILO` int NOT NULL,
    `ID_PISCINA` int NOT NULL,
    PRIMARY KEY (`IDINDICE`),
    KEY `FK_INDICE_PISCINA` (`ID_PISCINA`),
    KEY `FK_INDICE_CATEGORIA` (`ID_CATEGORIA`),
    CONSTRAINT `FK_INDICE_CATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `tb_categoria` (`IDCATEGORIA`),
    CONSTRAINT `FK_INDICE_PISCINA` FOREIGN KEY (`ID_PISCINA`) REFERENCES `tb_piscina` (`IDPISCINA`)
) ENGINE = InnoDB AUTO_INCREMENT = 203 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_indices`
--
LOCK TABLES `tb_indices` WRITE;
/*!40000 ALTER TABLE `tb_indices` DISABLE KEYS */
;
INSERT INTO `tb_indices`
VALUES (
        1,
        2023,
        '00:00:30.75',
        13,
        'F',
        'Brasileiro Inverno',
        2,
        1
    ),
    (
        2,
        2024,
        '00:00:31.60',
        13,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        3,
        2024,
        '00:00:30.93',
        14,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        4,
        2024,
        '00:00:30.48',
        15,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        5,
        2024,
        '00:00:30.10',
        16,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        6,
        2024,
        '00:00:29.80',
        17,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        7,
        2024,
        '00:00:29.51',
        18,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        8,
        2024,
        '00:00:29.51',
        99,
        'F',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        9,
        2024,
        '00:00:28.86',
        13,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        10,
        2024,
        '00:00:27.28',
        14,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        11,
        2024,
        '00:00:26.48',
        15,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        12,
        2024,
        '00:00:25.97',
        16,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        13,
        2024,
        '00:00:25.55',
        17,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        14,
        2024,
        '00:00:25.24',
        18,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        15,
        2024,
        '00:00:25.24',
        99,
        'M',
        'Brasileiro Inverno',
        2,
        2
    ),
    (
        16,
        2024,
        '00:01:09.04',
        13,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        17,
        2024,
        '00:01:07.58',
        14,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        18,
        2024,
        '00:01:06.60',
        15,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        19,
        2024,
        '00:01:05.77',
        16,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        20,
        2024,
        '00:01:05.10',
        17,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        21,
        2024,
        '00:01:04.47',
        18,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        22,
        2024,
        '00:01:04.47',
        99,
        'F',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        23,
        2024,
        '00:01:03.66',
        13,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        24,
        2024,
        '00:01:00.33',
        14,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        25,
        2024,
        '00:00:58.26',
        15,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        26,
        2024,
        '00:00:57.18',
        16,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        27,
        2024,
        '00:00:56.31',
        17,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        28,
        2024,
        '00:00:55.68',
        18,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        29,
        2024,
        '00:00:55.68',
        99,
        'M',
        'Brasileiro Inverno',
        3,
        2
    ),
    (
        30,
        2024,
        '00:02:30.86',
        13,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        31,
        2024,
        '00:02:27.65',
        14,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        32,
        2024,
        '00:02:25.51',
        15,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        33,
        2024,
        '00:02:23.79',
        16,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        34,
        2024,
        '00:02:22.25',
        17,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        35,
        2024,
        '00:02:20.85',
        18,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        36,
        2024,
        '00:02:20.85',
        99,
        'F',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        37,
        2024,
        '00:02:22.08',
        13,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        38,
        2024,
        '00:02:13.10',
        14,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        39,
        2024,
        '00:02:08.34',
        15,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        40,
        2024,
        '00:02:05.88',
        16,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        41,
        2024,
        '00:02:03.89',
        17,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        42,
        2024,
        '00:02:02.45',
        18,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        43,
        2024,
        '00:02:02.45',
        99,
        'M',
        'Brasileiro Inverno',
        4,
        2
    ),
    (
        44,
        2024,
        '00:05:15.74',
        13,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        45,
        2024,
        '00:05:09.02',
        14,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        46,
        2024,
        '00:05:04.56',
        15,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        47,
        2024,
        '00:05:00.96',
        16,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        48,
        2024,
        '00:04:57.72',
        17,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        49,
        2024,
        '00:04:54.89',
        18,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        50,
        2024,
        '00:04:54.89',
        99,
        'F',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        51,
        2024,
        '00:04:58.68',
        13,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        52,
        2024,
        '00:04:43.04',
        14,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        53,
        2024,
        '00:04:33.32',
        15,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        54,
        2024,
        '00:04:28.27',
        16,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        55,
        2024,
        '00:04:24.19',
        17,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        56,
        2024,
        '00:04:21.21',
        18,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        57,
        2024,
        '00:04:21.21',
        99,
        'M',
        'Brasileiro Inverno',
        5,
        2
    ),
    (
        58,
        2024,
        '00:10:52.56',
        13,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        59,
        2024,
        '00:10:38.35',
        14,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        60,
        2024,
        '00:10:28.92',
        15,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        61,
        2024,
        '00:10:20.89',
        16,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        62,
        2024,
        '00:10:14.50',
        17,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        63,
        2024,
        '00:10:08.37',
        18,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        64,
        2024,
        '00:10:08.37',
        99,
        'F',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        65,
        2024,
        '00:10:24.20',
        13,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        66,
        2024,
        '00:09:54.43',
        14,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        67,
        2024,
        '00:09:36.64',
        15,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        68,
        2024,
        '00:09:25.15',
        16,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        69,
        2024,
        '00:09:15.89',
        17,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        70,
        2024,
        '00:09:09.17',
        18,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        71,
        2024,
        '00:09:09.17',
        99,
        'M',
        'Brasileiro Inverno',
        6,
        2
    ),
    (
        72,
        2024,
        '00:20:39.04',
        13,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        73,
        2024,
        '00:20:12.05',
        14,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        74,
        2024,
        '00:19:54.15',
        15,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        75,
        2024,
        '00:19:38.90',
        16,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        76,
        2024,
        '00:19:26.77',
        17,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        77,
        2024,
        '00:19:15.13',
        18,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        78,
        2024,
        '00:19:15.13',
        99,
        'F',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        79,
        2024,
        '00:20:02.54',
        13,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        80,
        2024,
        '00:19:05.18',
        14,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        81,
        2024,
        '00:18:30.91',
        15,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        82,
        2024,
        '00:18:08.77',
        16,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        83,
        2024,
        '00:17:50.94',
        17,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        84,
        2024,
        '00:17:37.99',
        18,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        85,
        2024,
        '00:17:37.99',
        99,
        'M',
        'Brasileiro Inverno',
        7,
        2
    ),
    (
        86,
        2024,
        '00:01:21.52',
        13,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        87,
        2024,
        '00:01:19.45',
        14,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        88,
        2024,
        '00:01:18.10',
        15,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        89,
        2024,
        '00:01:16.95',
        16,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        90,
        2024,
        '00:01:16.05',
        17,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        91,
        2024,
        '00:01:15.19',
        18,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        92,
        2024,
        '00:01:15.19',
        99,
        'F',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        93,
        2024,
        '00:01:17.45',
        13,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        94,
        2024,
        '00:01:12.22',
        14,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        95,
        2024,
        '00:01:09.12',
        15,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        96,
        2024,
        '00:01:07.56',
        16,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        97,
        2024,
        '00:01:06.31',
        17,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        98,
        2024,
        '00:01:05.41',
        18,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        99,
        2024,
        '00:01:05.41',
        99,
        'M',
        'Brasileiro Inverno',
        14,
        2
    ),
    (
        100,
        2024,
        '00:02:55.03',
        13,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        101,
        2024,
        '00:02:50.59',
        14,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        102,
        2024,
        '00:02:47.69',
        15,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        103,
        2024,
        '00:02:45.23',
        16,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        104,
        2024,
        '00:02:43.29',
        17,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        105,
        2024,
        '00:02:40.37',
        18,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        106,
        2024,
        '00:02:40.37',
        99,
        'F',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        107,
        2024,
        '00:02:47.18',
        13,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        108,
        2024,
        '00:02:35.89',
        14,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        109,
        2024,
        '00:02:29.21',
        15,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        110,
        2024,
        '00:02:25.83',
        16,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        111,
        2024,
        '00:02:23.14',
        17,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        112,
        2024,
        '00:02:21.19',
        18,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        113,
        2024,
        '00:02:21.19',
        99,
        'M',
        'Brasileiro Inverno',
        15,
        2
    ),
    (
        114,
        2024,
        '00:01:18.72',
        13,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        115,
        2024,
        '00:01:16.73',
        14,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        116,
        2024,
        '00:01:15.42',
        15,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        117,
        2024,
        '00:01:14.38',
        16,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        118,
        2024,
        '00:01:13.44',
        17,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        119,
        2024,
        '00:01:12.61',
        18,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        120,
        2024,
        '00:01:12.61',
        99,
        'F',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        121,
        2024,
        '00:01:13.86',
        13,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        122,
        2024,
        '00:01:08.88',
        14,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        123,
        2024,
        '00:01:05.92',
        15,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        124,
        2024,
        '00:01:04.43',
        16,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        125,
        2024,
        '00:01:03.24',
        17,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        126,
        2024,
        '00:01:02.38',
        18,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        127,
        2024,
        '00:01:02.38',
        99,
        'M',
        'Brasileiro Inverno',
        10,
        2
    ),
    (
        128,
        2024,
        '00:02:52.62',
        13,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        129,
        2024,
        '00:02:48.67',
        14,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        130,
        2024,
        '00:02:46.07',
        15,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        131,
        2024,
        '00:02:43.85',
        16,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        132,
        2024,
        '00:02:42.09',
        17,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        133,
        2024,
        '00:02:40.41',
        18,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        134,
        2024,
        '00:02:40.41',
        99,
        'F',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        135,
        2024,
        '00:02:41.76',
        13,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        136,
        2024,
        '00:02:32.95',
        14,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        137,
        2024,
        '00:02:27.46',
        15,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        138,
        2024,
        '00:02:24.40',
        16,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        139,
        2024,
        '00:02:21.94',
        17,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        140,
        2024,
        '00:02:20.16',
        18,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        141,
        2024,
        '00:02:20.16',
        99,
        'M',
        'Brasileiro Inverno',
        21,
        2
    ),
    (
        142,
        2024,
        '00:00:31.12',
        13,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        143,
        2024,
        '00:00:30.66',
        14,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        144,
        2024,
        '00:00:30.23',
        15,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        145,
        2024,
        '00:00:29.92',
        16,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        146,
        2024,
        '00:00:29.62',
        17,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        147,
        2024,
        '00:00:29.34',
        18,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        148,
        2024,
        '00:00:29.34',
        99,
        'F',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        149,
        2024,
        '00:00:27.92',
        13,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        150,
        2024,
        '00:00:26.70',
        14,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        151,
        2024,
        '00:00:26.17',
        15,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        152,
        2024,
        '00:00:25.67',
        16,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        153,
        2024,
        '00:00:25.36',
        17,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        154,
        2024,
        '00:00:25.07',
        18,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        155,
        2024,
        '00:00:25.07',
        99,
        'M',
        'Brasileiro Verão',
        2,
        2
    ),
    (
        156,
        2024,
        '00:01:07.98',
        13,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        157,
        2024,
        '00:01:06.98',
        14,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        158,
        2024,
        '00:01:06.04',
        15,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        159,
        2024,
        '00:01:05.36',
        16,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        160,
        2024,
        '00:01:04.72',
        17,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        161,
        2024,
        '00:01:04.10',
        18,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        162,
        2024,
        '00:01:04.10',
        99,
        'F',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        163,
        2024,
        '00:01:01.67',
        13,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        164,
        2024,
        '00:00:58.71',
        14,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        165,
        2024,
        '00:00:57.60',
        15,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        166,
        2024,
        '00:00:56.57',
        16,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        167,
        2024,
        '00:00:55.93',
        17,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        168,
        2024,
        '00:00:55.31',
        18,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        169,
        2024,
        '00:00:55.31',
        99,
        'M',
        'Brasileiro Verão',
        3,
        2
    ),
    (
        170,
        2024,
        '00:02:28.54',
        13,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        171,
        2024,
        '00:02:26.35',
        14,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        172,
        2024,
        '00:02:24.29',
        15,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        173,
        2024,
        '00:02:22.82',
        16,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        174,
        2024,
        '00:02:21.40',
        17,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        175,
        2024,
        '00:02:20.05',
        18,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        176,
        2024,
        '00:02:20.05',
        99,
        'F',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        177,
        2024,
        '00:02:17.30',
        13,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        178,
        2024,
        '00:02:09.38',
        14,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        179,
        2024,
        '00:02:06.84',
        15,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        180,
        2024,
        '00:02:04.49',
        16,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        181,
        2024,
        '00:02:03.02',
        17,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        182,
        2024,
        '00:02:01.61',
        18,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        183,
        2024,
        '00:02:01.61',
        99,
        'M',
        'Brasileiro Verão',
        4,
        2
    ),
    (
        184,
        2024,
        '00:05:10.89',
        13,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        185,
        2024,
        '00:05:06.31',
        14,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        186,
        2024,
        '00:05:02.00',
        15,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        187,
        2024,
        '00:04:58.92',
        16,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        188,
        2024,
        '00:04:55.96',
        17,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        189,
        2024,
        '00:04:53.11',
        18,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        190,
        2024,
        '00:04:53.11',
        99,
        'F',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        191,
        2024,
        '00:04:49.34',
        13,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        192,
        2024,
        '00:04:35.44',
        14,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        193,
        2024,
        '00:04:30.24',
        15,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        194,
        2024,
        '00:04:25.42',
        16,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        195,
        2024,
        '00:04:22.38',
        17,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        196,
        2024,
        '00:04:19.48',
        18,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        197,
        2024,
        '00:04:19.48',
        99,
        'M',
        'Brasileiro Verão',
        5,
        2
    ),
    (
        198,
        2024,
        '00:01:10.85',
        13,
        'M',
        'Brasileiro Verão',
        10,
        2
    ),
    (
        201,
        2024,
        '00:01:06.56',
        14,
        'M',
        'Brasileiro Verão',
        10,
        2
    ),
    (
        202,
        2024,
        '00:01:05.01',
        15,
        'M',
        'Brasileiro Verão',
        10,
        2
    );
/*!40000 ALTER TABLE `tb_indices` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_metaAtleta`
--
DROP TABLE IF EXISTS `tb_metaAtleta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_metaAtleta` (
    `IDMETAATLETA` int NOT NULL AUTO_INCREMENT,
    `tempoMetaAtleta` time(2) NOT NULL,
    `ID_PISCINA` int NOT NULL,
    `ID_DISTANCIAESTILO` int NOT NULL,
    `ID_ATLETA` int NOT NULL,
    PRIMARY KEY (`IDMETAATLETA`),
    KEY `FK_METAATLETA_ATLETA` (`ID_ATLETA`),
    KEY `FK_METAATLETA_PISCINA` (`ID_PISCINA`),
    CONSTRAINT `FK_METAATLETA_ATLETA` FOREIGN KEY (`ID_ATLETA`) REFERENCES `tb_atleta` (`IDATLETA`),
    CONSTRAINT `FK_METAATLETA_PISCINA` FOREIGN KEY (`ID_PISCINA`) REFERENCES `tb_piscina` (`IDPISCINA`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_metaAtleta`
--
LOCK TABLES `tb_metaAtleta` WRITE;
/*!40000 ALTER TABLE `tb_metaAtleta` DISABLE KEYS */
;
/*!40000 ALTER TABLE `tb_metaAtleta` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_piscina`
--
DROP TABLE IF EXISTS `tb_piscina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_piscina` (
    `IDPISCINA` int NOT NULL AUTO_INCREMENT,
    `tamanhoPiscina` int NOT NULL,
    PRIMARY KEY (`IDPISCINA`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_piscina`
--
LOCK TABLES `tb_piscina` WRITE;
/*!40000 ALTER TABLE `tb_piscina` DISABLE KEYS */
;
INSERT INTO `tb_piscina`
VALUES (1, 25),
    (2, 50),
    (3, 0);
/*!40000 ALTER TABLE `tb_piscina` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_prova`
--
DROP TABLE IF EXISTS `tb_prova`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_prova` (
    `IDPROVA` int NOT NULL AUTO_INCREMENT,
    `numeroProva` int NOT NULL,
    `genero` enum('M', 'F') NOT NULL,
    `recordeProvaTorneio` time(2) DEFAULT NULL,
    `atletaRecordeProva` varchar(60) DEFAULT NULL,
    `dataRecorde` date DEFAULT NULL,
    `ID_TORNEIO` int DEFAULT NULL,
    `ID_DISTANCIAESTILO` int NOT NULL,
    `ID_CATEGORIA_MIN` int NOT NULL,
    `ID_CATEGORIA_MAX` int DEFAULT NULL,
    PRIMARY KEY (`IDPROVA`),
    KEY `FK_PROVA_CATEGORIA_MIN` (`ID_CATEGORIA_MIN`),
    KEY `FK_PROVA_CATEGORIA_MAX` (`ID_CATEGORIA_MAX`),
    KEY `FK_PROVA_TORNEIO` (`ID_TORNEIO`),
    KEY `FK_PROVA_DISTANCIAESTILO` (`ID_DISTANCIAESTILO`),
    CONSTRAINT `FK_PROVA_CATEGORIA_MAX` FOREIGN KEY (`ID_CATEGORIA_MAX`) REFERENCES `tb_categoria` (`IDCATEGORIA`),
    CONSTRAINT `FK_PROVA_CATEGORIA_MIN` FOREIGN KEY (`ID_CATEGORIA_MIN`) REFERENCES `tb_categoria` (`IDCATEGORIA`),
    CONSTRAINT `FK_PROVA_DISTANCIAESTILO` FOREIGN KEY (`ID_DISTANCIAESTILO`) REFERENCES `tba_distancia_estilo` (`IDDISTANCIAESTILO`),
    CONSTRAINT `FK_PROVA_TORNEIO` FOREIGN KEY (`ID_TORNEIO`) REFERENCES `tb_torneio` (`IDTORNEIO`)
) ENGINE = InnoDB AUTO_INCREMENT = 218 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_prova`
--
LOCK TABLES `tb_prova` WRITE;
/*!40000 ALTER TABLE `tb_prova` DISABLE KEYS */
;
INSERT INTO `tb_prova`
VALUES (1, 1, 'F', NULL, NULL, NULL, 3, 5, 13, 99),
    (2, 2, 'M', NULL, NULL, NULL, 3, 5, 13, 99),
    (3, 3, 'F', NULL, NULL, NULL, 3, 5, 11, 12),
    (4, 4, 'M', NULL, NULL, NULL, 3, 5, 11, 12),
    (5, 5, 'F', NULL, NULL, NULL, 3, 9, 15, 99),
    (6, 6, 'M', NULL, NULL, NULL, 3, 9, 15, 99),
    (7, 7, 'F', NULL, NULL, NULL, 3, 3, 11, 12),
    (8, 8, 'M', NULL, NULL, NULL, 3, 3, 11, 12),
    (9, 9, 'F', NULL, NULL, NULL, 3, 19, 12, 99),
    (10, 10, 'M', NULL, NULL, NULL, 3, 19, 12, 99),
    (11, 11, 'F', NULL, NULL, NULL, 3, 14, 13, 99),
    (12, 12, 'M', NULL, NULL, NULL, 3, 14, 13, 99),
    (13, 13, 'F', NULL, NULL, NULL, 3, 14, 11, 12),
    (14, 14, 'M', NULL, NULL, NULL, 3, 14, 11, 12),
    (15, 15, 'F', NULL, NULL, NULL, 3, 3, 13, 99),
    (16, 16, 'M', NULL, NULL, NULL, 3, 3, 13, 99),
    (17, 17, 'F', NULL, NULL, NULL, 3, 21, 11, 12),
    (18, 18, 'M', NULL, NULL, NULL, 3, 21, 11, 12),
    (19, 19, 'F', NULL, NULL, NULL, 3, 21, 13, 99),
    (20, 20, 'M', NULL, NULL, NULL, 3, 21, 13, 99),
    (21, 21, 'F', NULL, NULL, NULL, 3, 11, 12, 99),
    (22, 22, 'M', NULL, NULL, NULL, 3, 11, 12, 99),
    (23, 23, 'F', NULL, NULL, NULL, 3, 17, 15, 99),
    (24, 24, 'M', NULL, NULL, NULL, 3, 17, 15, 99),
    (25, 25, 'F', NULL, NULL, NULL, 3, 6, 12, 99),
    (26, 26, 'M', NULL, NULL, NULL, 3, 6, 12, 99),
    (27, 27, 'F', NULL, NULL, NULL, 3, 4, 13, 99),
    (28, 28, 'M', NULL, NULL, NULL, 3, 4, 13, 99),
    (29, 29, 'F', NULL, NULL, NULL, 3, 4, 11, 12),
    (30, 30, 'M', NULL, NULL, NULL, 3, 4, 11, 12),
    (31, 31, 'F', NULL, NULL, NULL, 3, 10, 13, 99),
    (32, 32, 'M', NULL, NULL, NULL, 3, 10, 13, 99),
    (33, 33, 'F', NULL, NULL, NULL, 3, 10, 11, 12),
    (34, 34, 'M', NULL, NULL, NULL, 3, 10, 11, 99),
    (35, 35, 'F', NULL, NULL, NULL, 3, 13, 15, 99),
    (36, 36, 'M', NULL, NULL, NULL, 3, 13, 15, 99),
    (37, 37, 'F', NULL, NULL, NULL, 3, 22, 13, 99),
    (38, 38, 'M', NULL, NULL, NULL, 3, 22, 13, 99),
    (39, 39, 'F', NULL, NULL, NULL, 3, 2, 11, 12),
    (40, 40, 'M', NULL, NULL, NULL, 3, 2, 11, 12),
    (41, 41, 'F', NULL, NULL, NULL, 3, 2, 13, 99),
    (42, 42, 'M', NULL, NULL, NULL, 3, 2, 13, 99),
    (43, 43, 'F', NULL, NULL, NULL, 3, 15, 12, 99),
    (44, 44, 'M', NULL, NULL, NULL, 3, 15, 12, 99),
    (45, 45, 'F', NULL, NULL, NULL, 3, 18, 11, 12),
    (46, 46, 'M', NULL, NULL, NULL, 3, 18, 11, 12),
    (47, 47, 'F', NULL, NULL, NULL, 3, 18, 13, 99),
    (48, 48, 'M', NULL, NULL, NULL, 3, 18, 13, 99),
    (49, 49, 'F', NULL, NULL, NULL, 3, 7, 13, 99),
    (50, 50, 'M', NULL, NULL, NULL, 3, 7, 13, 99),
    (51, 1, 'F', NULL, NULL, NULL, 1, 5, 13, 99),
    (52, 2, 'M', NULL, NULL, NULL, 1, 5, 13, 99),
    (53, 3, 'F', NULL, NULL, NULL, 1, 5, 11, 12),
    (54, 4, 'M', NULL, NULL, NULL, 1, 5, 11, 12),
    (55, 5, 'F', NULL, NULL, NULL, 1, 9, 15, 99),
    (56, 6, 'M', NULL, NULL, NULL, 1, 9, 15, 99),
    (57, 7, 'F', NULL, NULL, NULL, 1, 3, 11, 12),
    (58, 8, 'M', NULL, NULL, NULL, 1, 3, 11, 12),
    (59, 9, 'F', NULL, NULL, NULL, 1, 19, 12, 99),
    (60, 10, 'M', NULL, NULL, NULL, 1, 19, 12, 99),
    (61, 11, 'F', NULL, NULL, NULL, 1, 14, 13, 99),
    (62, 12, 'M', NULL, NULL, NULL, 1, 14, 13, 99),
    (63, 13, 'F', NULL, NULL, NULL, 1, 14, 11, 12),
    (64, 14, 'M', NULL, NULL, NULL, 1, 14, 11, 12),
    (65, 15, 'F', NULL, NULL, NULL, 1, 3, 13, 99),
    (66, 16, 'M', NULL, NULL, NULL, 1, 3, 13, 99),
    (67, 17, 'F', NULL, NULL, NULL, 1, 21, 11, 12),
    (68, 18, 'M', NULL, NULL, NULL, 1, 21, 11, 12),
    (69, 19, 'F', NULL, NULL, NULL, 1, 21, 13, 99),
    (70, 20, 'M', NULL, NULL, NULL, 1, 21, 13, 99),
    (71, 21, 'F', NULL, NULL, NULL, 1, 11, 12, 99),
    (72, 22, 'M', NULL, NULL, NULL, 1, 11, 12, 99),
    (73, 23, 'F', NULL, NULL, NULL, 1, 17, 15, 99),
    (74, 24, 'M', NULL, NULL, NULL, 1, 17, 15, 99),
    (75, 25, 'F', NULL, NULL, NULL, 1, 6, 12, 99),
    (76, 26, 'M', NULL, NULL, NULL, 1, 6, 12, 99),
    (77, 27, 'F', NULL, NULL, NULL, 1, 4, 13, 99),
    (78, 28, 'M', NULL, NULL, NULL, 1, 4, 13, 99),
    (79, 29, 'F', NULL, NULL, NULL, 1, 4, 11, 12),
    (80, 30, 'M', NULL, NULL, NULL, 1, 4, 11, 12),
    (81, 31, 'F', NULL, NULL, NULL, 1, 10, 13, 99),
    (82, 32, 'M', NULL, NULL, NULL, 1, 10, 13, 99),
    (83, 33, 'F', NULL, NULL, NULL, 1, 10, 11, 12),
    (84, 34, 'M', NULL, NULL, NULL, 1, 10, 11, 99),
    (85, 35, 'F', NULL, NULL, NULL, 1, 13, 15, 99),
    (86, 36, 'M', NULL, NULL, NULL, 1, 13, 15, 99),
    (87, 37, 'F', NULL, NULL, NULL, 1, 22, 13, 99),
    (88, 38, 'M', NULL, NULL, NULL, 1, 22, 13, 99),
    (89, 39, 'F', NULL, NULL, NULL, 1, 2, 11, 12),
    (90, 40, 'M', NULL, NULL, NULL, 1, 2, 11, 12),
    (91, 41, 'F', NULL, NULL, NULL, 1, 2, 13, 99),
    (92, 42, 'M', NULL, NULL, NULL, 1, 2, 13, 99),
    (93, 43, 'F', NULL, NULL, NULL, 1, 15, 12, 99),
    (94, 44, 'M', NULL, NULL, NULL, 1, 15, 12, 99),
    (95, 45, 'F', NULL, NULL, NULL, 1, 18, 11, 12),
    (96, 46, 'M', NULL, NULL, NULL, 1, 18, 11, 12),
    (97, 47, 'F', NULL, NULL, NULL, 1, 18, 13, 99),
    (98, 48, 'M', NULL, NULL, NULL, 1, 18, 13, 99),
    (99, 49, 'F', NULL, NULL, NULL, 1, 7, 13, 99),
    (100, 50, 'M', NULL, NULL, NULL, 1, 7, 13, 99),
    (101, 1, 'F', NULL, NULL, NULL, 4, 5, 13, 99),
    (102, 2, 'M', NULL, NULL, NULL, 4, 5, 13, 99),
    (103, 3, 'F', NULL, NULL, NULL, 4, 5, 11, 12),
    (104, 4, 'M', NULL, NULL, NULL, 4, 5, 11, 12),
    (105, 5, 'F', NULL, NULL, NULL, 4, 9, 15, 99),
    (106, 6, 'M', NULL, NULL, NULL, 4, 9, 15, 99),
    (107, 7, 'F', NULL, NULL, NULL, 4, 3, 11, 12),
    (108, 8, 'M', NULL, NULL, NULL, 4, 3, 11, 12),
    (109, 9, 'F', NULL, NULL, NULL, 4, 19, 12, 99),
    (110, 10, 'M', NULL, NULL, NULL, 4, 19, 12, 99),
    (111, 11, 'F', NULL, NULL, NULL, 4, 14, 13, 99),
    (112, 12, 'M', NULL, NULL, NULL, 4, 14, 13, 99),
    (113, 13, 'F', NULL, NULL, NULL, 4, 14, 11, 12),
    (114, 14, 'M', NULL, NULL, NULL, 4, 14, 11, 12),
    (115, 15, 'F', NULL, NULL, NULL, 4, 3, 13, 99),
    (116, 16, 'M', NULL, NULL, NULL, 4, 3, 13, 99),
    (117, 17, 'F', NULL, NULL, NULL, 4, 21, 11, 12),
    (118, 18, 'M', NULL, NULL, NULL, 4, 21, 11, 12),
    (119, 19, 'F', NULL, NULL, NULL, 4, 21, 13, 99),
    (120, 20, 'M', NULL, NULL, NULL, 4, 21, 13, 99),
    (121, 21, 'F', NULL, NULL, NULL, 4, 11, 12, 99),
    (122, 22, 'M', NULL, NULL, NULL, 4, 11, 12, 99),
    (123, 23, 'F', NULL, NULL, NULL, 4, 17, 15, 99),
    (124, 24, 'M', NULL, NULL, NULL, 4, 17, 15, 99),
    (125, 25, 'F', NULL, NULL, NULL, 4, 6, 12, 99),
    (126, 26, 'M', NULL, NULL, NULL, 4, 6, 12, 99),
    (127, 27, 'F', NULL, NULL, NULL, 4, 4, 13, 99),
    (128, 28, 'M', NULL, NULL, NULL, 4, 4, 13, 99),
    (129, 29, 'F', NULL, NULL, NULL, 4, 4, 11, 12),
    (130, 30, 'M', NULL, NULL, NULL, 4, 4, 11, 12),
    (131, 31, 'F', NULL, NULL, NULL, 4, 10, 13, 99),
    (132, 32, 'M', NULL, NULL, NULL, 4, 10, 13, 99),
    (133, 33, 'F', NULL, NULL, NULL, 4, 10, 11, 12),
    (134, 34, 'M', NULL, NULL, NULL, 4, 10, 11, 99),
    (135, 35, 'F', NULL, NULL, NULL, 4, 13, 15, 99),
    (136, 36, 'M', NULL, NULL, NULL, 4, 13, 15, 99),
    (137, 37, 'F', NULL, NULL, NULL, 4, 22, 13, 99),
    (138, 38, 'M', NULL, NULL, NULL, 4, 22, 13, 99),
    (139, 39, 'F', NULL, NULL, NULL, 4, 2, 11, 12),
    (140, 40, 'M', NULL, NULL, NULL, 4, 2, 11, 12),
    (141, 41, 'F', NULL, NULL, NULL, 4, 2, 13, 99),
    (142, 42, 'M', NULL, NULL, NULL, 4, 2, 13, 99),
    (143, 43, 'F', NULL, NULL, NULL, 4, 15, 12, 99),
    (144, 44, 'M', NULL, NULL, NULL, 4, 15, 12, 99),
    (145, 45, 'F', NULL, NULL, NULL, 4, 18, 11, 12),
    (146, 46, 'M', NULL, NULL, NULL, 4, 18, 11, 12),
    (147, 47, 'F', NULL, NULL, NULL, 4, 18, 13, 99),
    (148, 48, 'M', NULL, NULL, NULL, 4, 18, 13, 99),
    (149, 49, 'F', NULL, NULL, NULL, 4, 7, 13, 99),
    (150, 50, 'M', NULL, NULL, NULL, 4, 7, 13, 99),
    (151, 1, 'F', NULL, NULL, NULL, 5, 14, 13, 13),
    (152, 2, 'F', NULL, NULL, NULL, 5, 14, 14, 14),
    (153, 3, 'M', NULL, NULL, NULL, 5, 11, 13, 13),
    (154, 4, 'M', NULL, NULL, NULL, 5, 11, 14, 14),
    (155, 5, 'F', NULL, NULL, NULL, 5, 7, 13, 13),
    (156, 6, 'F', NULL, NULL, NULL, 5, 7, 14, 14),
    (157, 7, 'M', NULL, NULL, NULL, 5, 14, 13, 13),
    (158, 8, 'M', NULL, NULL, NULL, 5, 14, 14, 14),
    (159, 9, 'F', NULL, NULL, NULL, 5, 11, 13, 13),
    (160, 10, 'F', NULL, NULL, NULL, 5, 11, 14, 14),
    (161, 11, 'M', NULL, NULL, NULL, 5, 21, 13, 13),
    (162, 12, 'M', NULL, NULL, NULL, 5, 21, 14, 14),
    (163, 15, 'M', NULL, NULL, NULL, 5, 3, 13, 13),
    (164, 16, 'M', NULL, NULL, NULL, 5, 3, 14, 14),
    (165, 17, 'F', NULL, NULL, NULL, 5, 4, 13, 13),
    (166, 18, 'F', NULL, NULL, NULL, 5, 4, 14, 14),
    (167, 19, 'M', NULL, NULL, NULL, 5, 7, 13, 13),
    (168, 20, 'M', NULL, NULL, NULL, 5, 7, 14, 14),
    (169, 21, 'F', NULL, NULL, NULL, 5, 21, 13, 13),
    (170, 22, 'F', NULL, NULL, NULL, 5, 21, 14, 14),
    (171, 23, 'M', NULL, NULL, NULL, 5, 19, 13, 13),
    (172, 24, 'M', NULL, NULL, NULL, 5, 19, 14, 14),
    (173, 26, 'F', NULL, NULL, NULL, 5, 3, 13, 13),
    (174, 27, 'F', NULL, NULL, NULL, 5, 3, 14, 14),
    (175, 28, 'M', NULL, NULL, NULL, 5, 4, 13, 13),
    (176, 29, 'M', NULL, NULL, NULL, 5, 4, 14, 14),
    (177, 30, 'F', NULL, NULL, NULL, 5, 6, 13, 13),
    (178, 31, 'F', NULL, NULL, NULL, 5, 6, 14, 14),
    (179, 32, 'M', NULL, NULL, NULL, 5, 22, 13, 13),
    (180, 33, 'M', NULL, NULL, NULL, 5, 22, 14, 14),
    (181, 34, 'F', NULL, NULL, NULL, 5, 19, 13, 13),
    (182, 35, 'F', NULL, NULL, NULL, 5, 19, 14, 14),
    (183, 36, 'M', NULL, NULL, NULL, 5, 10, 13, 13),
    (184, 37, 'M', NULL, NULL, NULL, 5, 10, 14, 14),
    (185, 38, 'F', NULL, NULL, NULL, 5, 15, 13, 13),
    (186, 39, 'F', NULL, NULL, NULL, 5, 15, 14, 14),
    (187, 40, 'M', NULL, NULL, NULL, 5, 6, 13, 13),
    (188, 41, 'M', NULL, NULL, NULL, 5, 6, 14, 14),
    (189, 42, 'F', NULL, NULL, NULL, 5, 10, 13, 13),
    (190, 43, 'F', NULL, NULL, NULL, 5, 10, 14, 14),
    (191, 44, 'M', NULL, NULL, NULL, 5, 15, 13, 13),
    (192, 45, 'M', NULL, NULL, NULL, 5, 15, 14, 14),
    (193, 46, 'F', NULL, NULL, NULL, 5, 22, 13, 13),
    (194, 47, 'F', NULL, NULL, NULL, 5, 22, 14, 14),
    (195, 50, 'F', NULL, NULL, NULL, 5, 5, 13, 13),
    (196, 51, 'F', NULL, NULL, NULL, 5, 5, 14, 14),
    (197, 52, 'M', NULL, NULL, NULL, 5, 18, 13, 13),
    (198, 53, 'M', NULL, NULL, NULL, 5, 18, 14, 14),
    (199, 54, 'F', NULL, NULL, NULL, 5, 18, 13, 13),
    (200, 55, 'F', NULL, NULL, NULL, 5, 18, 14, 14),
    (201, 56, 'M', NULL, NULL, NULL, 5, 5, 13, 13),
    (202, 57, 'M', NULL, NULL, NULL, 5, 5, 14, 14),
    (203, 58, 'F', NULL, NULL, NULL, 5, 2, 13, 13),
    (204, 59, 'F', NULL, NULL, NULL, 5, 2, 14, 14),
    (205, 60, 'M', NULL, NULL, NULL, 5, 2, 13, 13),
    (206, 61, 'M', NULL, NULL, NULL, 5, 2, 14, 14),
    (207, 1, 'F', NULL, NULL, NULL, 6, 14, 13, 13),
    (208, 2, 'F', NULL, NULL, NULL, 6, 14, 14, 14),
    (209, 3, 'M', NULL, NULL, NULL, 6, 14, 13, 13),
    (210, 4, 'M', NULL, NULL, NULL, 6, 14, 14, 14),
    (211, 11, 'M', NULL, NULL, NULL, 6, 2, 13, 13),
    (212, 19, 'M', NULL, NULL, NULL, 6, 3, 13, 13),
    (213, 51, 'M', NULL, NULL, NULL, 6, 10, 13, 13),
    (214, 59, 'M', NULL, NULL, NULL, 6, 4, 13, 13),
    (216, 32, 'M', NULL, NULL, NULL, 9, 3, 12, 12),
    (217, 22, 'M', NULL, NULL, NULL, 9, 21, 12, 12);
/*!40000 ALTER TABLE `tb_prova` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_provaUsuario`
--
DROP TABLE IF EXISTS `tb_provaUsuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_provaUsuario` (
    `IDPROVAUSUARIO` int NOT NULL AUTO_INCREMENT,
    `numeroProvaUsuario` varchar(5) NOT NULL,
    `generoProvaUsuario` enum('M', 'F') NOT NULL,
    `finalUsuario` enum('S', 'N') DEFAULT NULL,
    `recordeProvaTorneioUsuario` time(2) DEFAULT NULL,
    `ID_TORNEIOUSUARIO` int DEFAULT NULL,
    `ID_DISTANCIAESTILO` int DEFAULT NULL,
    `ID_CATEGORIA_MIN` int DEFAULT NULL,
    `ID_CATEGORIA_MAX` int DEFAULT NULL,
    PRIMARY KEY (`IDPROVAUSUARIO`),
    KEY `FK_PROVAUSUARIO_CATEGORIA_MIN` (`ID_CATEGORIA_MIN`),
    KEY `FK_PROVAUSUARIO_CATEGORIA_MAX` (`ID_CATEGORIA_MAX`),
    KEY `FK_PROVAUSUARIO_TORNEIOUSUARIO` (`ID_TORNEIOUSUARIO`),
    KEY `FK_PROVAUSUARIO_DISTANCIAESTILO` (`ID_DISTANCIAESTILO`),
    CONSTRAINT `FK_PROVAUSUARIO_CATEGORIA_MAX` FOREIGN KEY (`ID_CATEGORIA_MAX`) REFERENCES `tb_categoria` (`IDCATEGORIA`),
    CONSTRAINT `FK_PROVAUSUARIO_CATEGORIA_MIN` FOREIGN KEY (`ID_CATEGORIA_MIN`) REFERENCES `tb_categoria` (`IDCATEGORIA`),
    CONSTRAINT `FK_PROVAUSUARIO_DISTANCIAESTILO` FOREIGN KEY (`ID_DISTANCIAESTILO`) REFERENCES `tba_distancia_estilo` (`IDDISTANCIAESTILO`),
    CONSTRAINT `FK_PROVAUSUARIO_TORNEIOUSUARIO` FOREIGN KEY (`ID_TORNEIOUSUARIO`) REFERENCES `tb_torneioUsuario` (`IDTORNEIOUSUARIO`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_provaUsuario`
--
LOCK TABLES `tb_provaUsuario` WRITE;
/*!40000 ALTER TABLE `tb_provaUsuario` DISABLE KEYS */
;
/*!40000 ALTER TABLE `tb_provaUsuario` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_recordes`
--
DROP TABLE IF EXISTS `tb_recordes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_recordes` (
    `IDRECORDE` int NOT NULL AUTO_INCREMENT,
    `tipoRecorde` varchar(30) NOT NULL,
    `dataRecorde` date NOT NULL,
    `nomeAtletaRecorde` varchar(60) DEFAULT NULL,
    `generoRecorde` enum('M', 'F') NOT NULL,
    `tempoRecorde` time(2) NOT NULL,
    `localRecorde` varchar(60) DEFAULT NULL,
    `nacionalidadeRecorde` varchar(60) DEFAULT NULL,
    `ID_CATEGORIA` int NOT NULL,
    `ID_DISTANCIAESTILO` int NOT NULL,
    `ID_PISCINA` int NOT NULL,
    PRIMARY KEY (`IDRECORDE`),
    KEY `FK_RECORDE_PISCINA` (`ID_PISCINA`),
    KEY `FK_RECORDE_CATEGORIA` (`ID_CATEGORIA`),
    CONSTRAINT `FK_RECORDE_CATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `tb_categoria` (`IDCATEGORIA`),
    CONSTRAINT `FK_RECORDE_PISCINA` FOREIGN KEY (`ID_PISCINA`) REFERENCES `tb_piscina` (`IDPISCINA`)
) ENGINE = InnoDB AUTO_INCREMENT = 26 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_recordes`
--
LOCK TABLES `tb_recordes` WRITE;
/*!40000 ALTER TABLE `tb_recordes` DISABLE KEYS */
;
INSERT INTO `tb_recordes`
VALUES (
        1,
        'Recorde Mundial',
        '2023-10-21',
        'Kaylee Mckeown',
        'F',
        '00:00:57.33',
        'Hungria',
        'Australia',
        99,
        14,
        2
    ),
    (
        2,
        'Recorde Mundial',
        '2022-06-21',
        'Kristof Milak',
        'M',
        '00:01:50.34',
        'Hungria',
        '',
        99,
        11,
        2
    ),
    (
        3,
        'Recorde Mundial',
        '2022-06-19',
        'Thomas Ceccon',
        'M',
        '00:00:51.60',
        'Hungria',
        'Italia',
        99,
        14,
        2
    ),
    (
        4,
        'Recorde Mundial',
        '2009-12-18',
        'Cesar Cielo Filho',
        'M',
        '00:00:20.91',
        'Brazilian National Championship - Brasil',
        'Brasil',
        99,
        2,
        2
    ),
    (
        5,
        'Recorde Mundial',
        '2024-02-11',
        'Zhanle Pan',
        'M',
        '00:00:46.80',
        'World Aquatics Championship - Doha',
        'China',
        99,
        3,
        2
    ),
    (
        6,
        'Recorde Mundial',
        '2021-07-31',
        'Caeleb Dressel',
        'M',
        '00:00:49.45',
        'Japão',
        'USA',
        99,
        10,
        2
    ),
    (
        11,
        'Recorde Mundial',
        '2009-07-28',
        'Paul Biedermann',
        'M',
        '00:01:42.00',
        'FINA World Championship - Italia',
        'Alemanha',
        99,
        4,
        2
    ),
    (
        12,
        'Recorde Mundial',
        '2009-07-26',
        'Paul Biedermann',
        'M',
        '00:03:40.07',
        'FINA World Championship - Italia',
        'Alemanha',
        99,
        5,
        2
    ),
    (
        13,
        'Recorde Mundial',
        '2009-07-29',
        'Lin Zhang',
        'M',
        '00:07:32.12',
        'FINA World Championship - Italia',
        'China',
        99,
        6,
        2
    ),
    (
        14,
        'Recorde Mundial',
        '2012-08-04',
        'Yang Sun',
        'M',
        '00:14:31.02',
        'Olympic Games London',
        'China',
        99,
        7,
        2
    ),
    (
        15,
        'Recorde Mundial',
        '2023-07-27',
        'Kliment Kolesnikov',
        'M',
        '00:00:23.55',
        'Russian National Swimming Cup',
        'Russia',
        99,
        13,
        2
    ),
    (
        16,
        'Recorde Mundial',
        '2009-07-31',
        'Aaron Peirsol',
        'M',
        '00:01:51.92',
        'FINA World Championship - Italia',
        'USA',
        99,
        15,
        2
    ),
    (
        17,
        'Recorde Mundial',
        '2017-07-25',
        'Adam Peaty',
        'M',
        '00:00:25.95',
        'FINA World Championship - Hungria',
        'Gra-Bretanha',
        99,
        17,
        2
    ),
    (
        18,
        'Recorde Mundial',
        '2019-07-21',
        'Adam Peaty',
        'M',
        '00:00:56.88',
        'FINA World Championship - Corea',
        'Gra-Bretanha',
        99,
        18,
        2
    ),
    (
        19,
        'Recorde Mundial',
        '2023-07-28',
        'Haiyang Qin',
        'M',
        '00:02:05.48',
        'World Aquatics Championship - Japao',
        'China',
        99,
        19,
        2
    ),
    (
        20,
        'Recorde Mundial',
        '2018-07-01',
        'Andrii Govorov',
        'M',
        '00:00:22.27',
        'International Trophy Sette Colli - Italia',
        'Ukrania',
        99,
        9,
        2
    ),
    (
        21,
        'Recorde Mundial',
        '2011-07-28',
        'Ryan Lochte',
        'M',
        '00:01:54.00',
        'FINA World Championship - China',
        'USA',
        99,
        21,
        2
    ),
    (
        22,
        'Recorde Mundial',
        '2023-07-23',
        'Leon Marchand',
        'M',
        '00:04:02.50',
        'World Aquatics Championship - Japao',
        'França',
        99,
        22,
        2
    ),
    (
        24,
        'Recorde Brasileiro',
        '2016-08-12',
        'Etiene Pires Medeiros',
        'F',
        '00:00:24.45',
        'Rio de Janeiro',
        'Brasil',
        99,
        2,
        2
    ),
    (
        25,
        'Recorde Brasileiro',
        '2015-06-27',
        'Aime Louise Silva Lourenço',
        'F',
        '00:00:26.65',
        'Belém',
        'Brasil',
        13,
        2,
        2
    );
/*!40000 ALTER TABLE `tb_recordes` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_tempoAtleta`
--
DROP TABLE IF EXISTS `tb_tempoAtleta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_tempoAtleta` (
    `IDTMPATLETA` int NOT NULL AUTO_INCREMENT,
    `tempoAtleta` time(2) NOT NULL,
    `final` enum('S', 'N') DEFAULT NULL,
    `ID_PROVA` int NOT NULL,
    `ID_ATLETA` int NOT NULL,
    PRIMARY KEY (`IDTMPATLETA`),
    KEY `FK_TEMPOATLETA_PROVA` (`ID_PROVA`),
    KEY `FK_TEMPOATLETA_ATLETA` (`ID_ATLETA`),
    CONSTRAINT `FK_TEMPOATLETA_ATLETA` FOREIGN KEY (`ID_ATLETA`) REFERENCES `tb_atleta` (`IDATLETA`),
    CONSTRAINT `FK_TEMPOATLETA_PROVA` FOREIGN KEY (`ID_PROVA`) REFERENCES `tb_prova` (`IDPROVA`)
) ENGINE = InnoDB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_tempoAtleta`
--
LOCK TABLES `tb_tempoAtleta` WRITE;
/*!40000 ALTER TABLE `tb_tempoAtleta` DISABLE KEYS */
;
INSERT INTO `tb_tempoAtleta`
VALUES (1, '00:01:02.57', 'N', 16, 2),
    (2, '00:02:21.41', 'N', 28, 2),
    (3, '00:02:47.24', 'N', 20, 2),
    (4, '00:00:27.66', 'N', 142, 2),
    (5, '00:01:13.37', 'N', 112, 2),
    (6, '00:02:38.42', 'N', 120, 2),
    (7, '00:01:10.74', 'N', 132, 2),
    (8, '00:01:00.42', 'N', 66, 2),
    (9, '00:02:18.13', 'N', 78, 2),
    (10, '00:00:26.60', 'N', 205, 2),
    (12, '00:00:26.53', 'S', 205, 2),
    (13, '00:01:05.07', 'S', 183, 2),
    (14, '00:01:06.67', 'N', 183, 2),
    (15, '00:01:11.28', 'N', 157, 2),
    (16, '00:01:00.27', 'N', 163, 2),
    (17, '00:00:59.25', 'S', 163, 2),
    (18, '00:00:26.29', 'N', 211, 2),
    (19, '00:00:58.67', 'N', 212, 2),
    (23, '00:01:05.95', 'N', 213, 2),
    (24, '00:01:01.00', 'N', 1, 6),
    (25, '00:01:05.00', 'N', 101, 6),
    (26, '00:00:32.25', 'N', 56, 7),
    (27, '00:00:58.55', 'N', 116, 7),
    (28, '00:02:14.21', 'N', 175, 2),
    (29, '00:02:13.59', 'N', 214, 2),
    (30, '00:01:11.89', 'N', 62, 2),
    (31, '00:01:11.14', 'N', 82, 2),
    (32, '00:01:06.06', 'N', 216, 2),
    (33, '00:02:49.51', 'N', 217, 2);
/*!40000 ALTER TABLE `tb_tempoAtleta` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_torneio`
--
DROP TABLE IF EXISTS `tb_torneio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_torneio` (
    `IDTORNEIO` int NOT NULL AUTO_INCREMENT,
    `nomeTorneio` varchar(100) NOT NULL,
    `dataTorneio` date NOT NULL,
    `dataFimTorneio` date DEFAULT NULL,
    `ID_COMPLEXO` int DEFAULT NULL,
    `ID_PISCINA` int DEFAULT NULL,
    `ID_FEDERACAO` int DEFAULT NULL,
    PRIMARY KEY (`IDTORNEIO`),
    KEY `FK_TORNEIO_PISCINA` (`ID_PISCINA`),
    KEY `FK_TORNEIO_FEDERACAO` (`ID_FEDERACAO`),
    KEY `FK_TORNEIO_COMPLEXO` (`ID_COMPLEXO`),
    CONSTRAINT `FK_TORNEIO_COMPLEXO` FOREIGN KEY (`ID_COMPLEXO`) REFERENCES `tb_complexo` (`IDCOMPLEXO`),
    CONSTRAINT `FK_TORNEIO_FEDERACAO` FOREIGN KEY (`ID_FEDERACAO`) REFERENCES `tb_federacao` (`IDFEDERACAO`),
    CONSTRAINT `FK_TORNEIO_PISCINA` FOREIGN KEY (`ID_PISCINA`) REFERENCES `tb_piscina` (`IDPISCINA`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_torneio`
--
LOCK TABLES `tb_torneio` WRITE;
/*!40000 ALTER TABLE `tb_torneio` DISABLE KEYS */
;
INSERT INTO `tb_torneio`
VALUES (
        1,
        '3o Torneio Regional Petiz a Senior',
        '2024-05-18',
        NULL,
        2,
        1,
        2
    ),
    (
        3,
        '1o Torneio Regional Petiz a Senior',
        '2024-03-16',
        NULL,
        2,
        2,
        2
    ),
    (
        4,
        '2o Torneio Regional Petiz a Senior',
        '2024-04-27',
        NULL,
        1,
        2,
        2
    ),
    (
        5,
        'Campeonato Brasileiro Interclubes Infantil de Inverno',
        '2024-06-10',
        '2024-06-15',
        3,
        2,
        1
    ),
    (
        6,
        'Campeonato Paulista Infantil de Natação de Inverno',
        '2024-07-05',
        '2024-07-07',
        4,
        2,
        2
    ),
    (
        9,
        '4o Torneio Regional Pre-Mirim a Senior',
        '2023-09-02',
        '2023-09-02',
        2,
        1,
        2
    );
/*!40000 ALTER TABLE `tb_torneio` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_torneioUsuario`
--
DROP TABLE IF EXISTS `tb_torneioUsuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_torneioUsuario` (
    `IDTORNEIOUSUARIO` int NOT NULL AUTO_INCREMENT,
    `nomeTorneioUsuario` varchar(100) NOT NULL,
    `dataTorneioUsuario` date NOT NULL,
    `dataFimTorneioUsuario` date DEFAULT NULL,
    `ID_COMPLEXO` int DEFAULT NULL,
    `ID_PISCINA` int DEFAULT NULL,
    `ID_FEDERACAO` int DEFAULT NULL,
    PRIMARY KEY (`IDTORNEIOUSUARIO`),
    KEY `FK_TORNEIOUSUARIO_PISCINA` (`ID_PISCINA`),
    KEY `FK_TORNEIOUSUARIO_FEDERACAO` (`ID_FEDERACAO`),
    KEY `FK_TORNEIOUSUARIO_COMPLEXO` (`ID_COMPLEXO`),
    CONSTRAINT `FK_TORNEIOUSUARIO_COMPLEXO` FOREIGN KEY (`ID_COMPLEXO`) REFERENCES `tb_complexo` (`IDCOMPLEXO`),
    CONSTRAINT `FK_TORNEIOUSUARIO_FEDERACAO` FOREIGN KEY (`ID_FEDERACAO`) REFERENCES `tb_federacao` (`IDFEDERACAO`),
    CONSTRAINT `FK_TORNEIOUSUARIO_PISCINA` FOREIGN KEY (`ID_PISCINA`) REFERENCES `tb_piscina` (`IDPISCINA`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_torneioUsuario`
--
LOCK TABLES `tb_torneioUsuario` WRITE;
/*!40000 ALTER TABLE `tb_torneioUsuario` DISABLE KEYS */
;
/*!40000 ALTER TABLE `tb_torneioUsuario` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tb_users`
--
DROP TABLE IF EXISTS `tb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tb_users` (
    `IDUSER` int NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `passwd` varchar(256) NOT NULL,
    `user_name` varchar(100) NOT NULL,
    `user_id` int NOT NULL,
    `permission` char(1) NOT NULL,
    PRIMARY KEY (`IDUSER`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tb_users`
--
LOCK TABLES `tb_users` WRITE;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */
;
INSERT INTO `tb_users`
VALUES (
        1,
        'tom@gmail.com',
        '01c056469d6a43e2a359c46fd12527a0b5eb6796',
        'tom@gmail.com',
        2,
        '1'
    ),
    (
        2,
        'fernando@gmail.com',
        'dfd31ba8540213c960115a47c42501ec1d4f5606',
        'fernando@gmail.com',
        1,
        '1'
    ),
    (
        3,
        'jean@gmail.com',
        '01c056469d6a43e2a359c46fd12527a0b5eb6796',
        'jean@gmail.com',
        0,
        '2'
    ),
    (
        4,
        'joaonadador@gmail.com',
        '7c4a8d09ca3762af61e59520943dc26494f8941b',
        'joaonadador@gmail.com',
        4,
        '1'
    ),
    (
        6,
        'andrezazaninete83@gmail.com',
        '96fb71449668603ae4ec60163016eef565c79d1d',
        'andrezazaninete83@gmail.com',
        6,
        '1'
    ),
    (
        7,
        'jose@gmail.com',
        '7c4a8d09ca3762af61e59520943dc26494f8941b',
        'jose@gmail.com',
        7,
        '1'
    );
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tba_distancia_estilo`
--
DROP TABLE IF EXISTS `tba_distancia_estilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tba_distancia_estilo` (
    `IDDISTANCIAESTILO` int NOT NULL AUTO_INCREMENT,
    `ID_DISTANCIA` int NOT NULL,
    `ID_ESTILO` int NOT NULL,
    PRIMARY KEY (`IDDISTANCIAESTILO`),
    KEY `FK_ESTILO_DISTANCIA` (`ID_ESTILO`),
    KEY `FK_DISTANCIA_ESTILO` (`ID_DISTANCIA`),
    CONSTRAINT `FK_DISTANCIA_ESTILO` FOREIGN KEY (`ID_DISTANCIA`) REFERENCES `tb_distancia` (`IDDISTANCIA`),
    CONSTRAINT `FK_ESTILO_DISTANCIA` FOREIGN KEY (`ID_ESTILO`) REFERENCES `tb_estilo` (`IDESTILO`)
) ENGINE = InnoDB AUTO_INCREMENT = 23 DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tba_distancia_estilo`
--
LOCK TABLES `tba_distancia_estilo` WRITE;
/*!40000 ALTER TABLE `tba_distancia_estilo` DISABLE KEYS */
;
INSERT INTO `tba_distancia_estilo`
VALUES (1, 1, 1),
    (2, 2, 1),
    (3, 3, 1),
    (4, 4, 1),
    (5, 5, 1),
    (6, 6, 1),
    (7, 7, 1),
    (8, 1, 2),
    (9, 2, 2),
    (10, 3, 2),
    (11, 4, 2),
    (12, 1, 3),
    (13, 2, 3),
    (14, 3, 3),
    (15, 4, 3),
    (16, 1, 4),
    (17, 2, 4),
    (18, 3, 4),
    (19, 4, 4),
    (20, 3, 5),
    (21, 4, 5),
    (22, 5, 5);
/*!40000 ALTER TABLE `tba_distancia_estilo` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `tba_prova_atleta`
--
DROP TABLE IF EXISTS `tba_prova_atleta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `tba_prova_atleta` (
    `IDPROVAATLETA` int NOT NULL AUTO_INCREMENT,
    `ID_PROVA` int DEFAULT NULL,
    `ID_ATLETA` int DEFAULT NULL,
    PRIMARY KEY (`IDPROVAATLETA`),
    KEY `FK_PROVAATLETA_PROVA` (`ID_PROVA`),
    KEY `FK_PROVAATLETA_ATLETA` (`ID_ATLETA`),
    CONSTRAINT `FK_PROVAATLETA_ATLETA` FOREIGN KEY (`ID_ATLETA`) REFERENCES `tb_atleta` (`IDATLETA`),
    CONSTRAINT `FK_PROVAATLETA_PROVA` FOREIGN KEY (`ID_PROVA`) REFERENCES `tb_prova` (`IDPROVA`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `tba_prova_atleta`
--
LOCK TABLES `tba_prova_atleta` WRITE;
/*!40000 ALTER TABLE `tba_prova_atleta` DISABLE KEYS */
;
/*!40000 ALTER TABLE `tba_prova_atleta` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2024-08-03 15:01:47
