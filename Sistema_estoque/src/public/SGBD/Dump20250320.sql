-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: estoque
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `qualificacao` varchar(100) NOT NULL,
  `cnhb` tinyint(1) NOT NULL,
  `cnhc` tinyint(1) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `inicio_na_empresa` date DEFAULT NULL,
  `efetivo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Jose Leite da Cruz','Ceo','Administração',1,0,100000.00,'0000-00-00',1),(2,'Mariana Souza','Gerente Administrativo','Administração',1,0,9500.00,'2023-05-10',1),(3,'Carlos Pereira','Analista Financeiro','Administração',0,0,8700.00,'2022-11-15',1),(4,'Fernanda Lima','Recursos Humanos','Administração',0,0,8200.00,'2021-07-20',1),(5,'João Batista','Assistente Administrativo','Administração',0,0,7200.00,'2023-09-01',1),(6,'Ana Oliveira','Atendente','Atendimento',0,0,3200.00,'2024-01-10',1),(7,'Roberto Silva','Atendente','Atendimento',0,0,3100.00,'2023-12-05',1),(8,'Paula Mendes','Atendente','Atendimento',0,0,3300.00,'2023-11-20',1),(9,'Fábio Nogueira','Atendente','Atendimento',0,0,3000.00,'2024-02-01',1),(10,'Tatiane Costa','Atendente','Atendimento',0,0,3400.00,'2023-08-15',1),(11,'Lucas Almeida','Encarregado de Obras','Engenharia Civil',1,1,9800.00,'2021-03-12',1),(12,'José Ricardo','Encarregado de Manutenção','Técnico em Manutenção',1,1,9200.00,'2020-10-25',1),(13,'Ricardo Gomes','Servente de Obras','Construção Civil',0,0,2800.00,'2023-06-18',1),(14,'Eduardo Ramos','Servente de Pedreiro','Construção Civil',0,0,2700.00,'2023-07-10',1),(15,'Marcelo Fernandes','Pedreiro','Construção Civil',1,0,7500.00,'2022-05-05',1),(16,'Jorge Santos','Pintor','Pintura',0,0,5000.00,'2021-09-22',1),(17,'Cícero Nunes','Eletricista','Elétrica',1,0,6800.00,'2021-12-10',1),(18,'Adriana Marques','Técnica em Segurança do Trabalho','Segurança do Trabalho',0,0,7300.00,'2023-03-01',1),(19,'Felipe Xavier','Mestre de Obras','Engenharia Civil',1,1,9700.00,'2020-07-14',1),(20,'Raquel Sousa','Almoxarife','Logística',0,0,4500.00,'2022-04-30',1),(21,'Matheus Braga','Motorista','Transporte',1,1,5200.00,'2021-02-15',1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais`
--

DROP TABLE IF EXISTS `materiais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiais` (
  `id_materiais` int NOT NULL AUTO_INCREMENT,
  `material` varchar(40) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `quantidade_estoque` int NOT NULL,
  PRIMARY KEY (`id_materiais`),
  UNIQUE KEY `material` (`material`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais`
--

LOCK TABLES `materiais` WRITE;
/*!40000 ALTER TABLE `materiais` DISABLE KEYS */;
INSERT INTO `materiais` VALUES (1,'Cimento Portland','Ligante Hidráulico',35.00,100),(2,'Areia Média','Agregado',75.00,200),(3,'Brita 1','Agregado',90.00,150),(4,'Tijolo Cerâmico','Alvenaria',0.80,5000),(5,'Bloco de Concreto','Alvenaria',3.50,1200),(6,'Viga de Aço','Estrutural',250.00,50),(7,'Telha de Fibrocimento','Cobertura',45.00,300),(8,'Tubo de PVC 100mm','Hidráulico',25.00,400),(9,'Ferro CA-50 12mm','Estrutural',38.00,500),(10,'Argamassa ACIII','Revestimento',25.50,250);
/*!40000 ALTER TABLE `materiais` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-20 13:06:30
