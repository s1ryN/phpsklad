DROP DATABASE IF EXISTS jakubsvoboda;
CREATE DATABASE  IF NOT EXISTS `jakubsvoboda` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jakubsvoboda`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: jakubsvoboda
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `inventura`
--

DROP TABLE IF EXISTS `inventura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventura` (
  `idInventura` int NOT NULL AUTO_INCREMENT UNIQUE,
  `ks` int NOT NULL DEFAULT '0',
  `Sklad_idSklad` int NOT NULL,
  `Polozka_idPolozka` int NOT NULL,
  `Pracovnik_idPracovnik` int NOT NULL,
  PRIMARY KEY (`idInventura`),
  KEY `fk_Inventura_Sklad_idx` (`Sklad_idSklad`),
  KEY `fk_Inventura_Polozka1_idx` (`Polozka_idPolozka`),
  KEY `fk_Inventura_Pracovnik1_idx` (`Pracovnik_idPracovnik`),
  CONSTRAINT `fk_Inventura_Polozka1` FOREIGN KEY (`Polozka_idPolozka`) REFERENCES `polozka` (`idPolozka`),
  CONSTRAINT `fk_Inventura_Pracovnik1` FOREIGN KEY (`Pracovnik_idPracovnik`) REFERENCES `pracovnik` (`idPracovnik`),
  CONSTRAINT `fk_Inventura_Sklad` FOREIGN KEY (`Sklad_idSklad`) REFERENCES `sklad` (`idSklad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventura`
--

LOCK TABLES `inventura` WRITE;
/*!40000 ALTER TABLE `inventura` DISABLE KEYS */;
INSERT INTO `inventura` VALUES (1,10,1,1,1),(2,5,2,2,2),(3,20,3,3,3),(4,15,4,4,4),(5,8,5,5,5);
/*!40000 ALTER TABLE `inventura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polozka`
--

DROP TABLE IF EXISTS `polozka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `polozka` (
  `idPolozka` int NOT NULL,
  `Nazev` varchar(45) NOT NULL,
  `Cena` int NOT NULL,
  `Vyrobce` varchar(45) NOT NULL,
  `Druh` varchar(45) NOT NULL,
  `InventarniCislo` int NOT NULL,
  PRIMARY KEY (`idPolozka`),
  UNIQUE KEY `Nazev_UNIQUE` (`Nazev`),
  UNIQUE KEY `InventarniCislo_UNIQUE` (`InventarniCislo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polozka`
--

LOCK TABLES `polozka` WRITE;
/*!40000 ALTER TABLE `polozka` DISABLE KEYS */;
INSERT INTO `polozka` VALUES (1,'Pocitac',20000,'Dell','Elektronika',1001),(2,'Monitor',5000,'Samsung','Elektronika',1002),(3,'Klavesnice',1000,'Logitech','Elektronika',1003),(4,'Mys',500,'Logitech','Elektronika',1004),(5,'Stul',3000,'IKEA','Nabytek',1005);
/*!40000 ALTER TABLE `polozka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pracovnik`
--

DROP TABLE IF EXISTS `pracovnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pracovnik` (
  `idPracovnik` int NOT NULL,
  `UzivatelskeJmeno` varchar(45) NOT NULL,
  `Heslo` varchar(45) NOT NULL,
  PRIMARY KEY (`idPracovnik`),
  UNIQUE KEY `Heslo_UNIQUE` (`Heslo`),
  UNIQUE KEY `UzivatelskeJmeno_UNIQUE` (`UzivatelskeJmeno`),
  UNIQUE KEY `idPracovnik_UNIQUE` (`idPracovnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pracovnik`
--

LOCK TABLES `pracovnik` WRITE;
/*!40000 ALTER TABLE `pracovnik` DISABLE KEYS */;
INSERT INTO `pracovnik` VALUES (1,'jnovak','heslo123'),(2,'jhorak','bezpecneHeslo'),(3,'karel','karelHeslo'),(4,'petra','petraHeslo'),(5,'lucie','lucieHeslo');
/*!40000 ALTER TABLE `pracovnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sklad`
--

DROP TABLE IF EXISTS `sklad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sklad` (
  `idSklad` int NOT NULL,
  `Nazev` varchar(45) NOT NULL,
  `Ulice` varchar(45) NOT NULL,
  `CisloPopisne` int NOT NULL,
  `Mesto` varchar(45) NOT NULL,
  `PSC` int NOT NULL,
  `Telefon` int NOT NULL,
  `Email` varchar(45) NOT NULL,
  PRIMARY KEY (`idSklad`),
  UNIQUE KEY `Telefon_UNIQUE` (`Telefon`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Nazev_UNIQUE` (`Nazev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sklad`
--

LOCK TABLES `sklad` WRITE;
/*!40000 ALTER TABLE `sklad` DISABLE KEYS */;
INSERT INTO `sklad` VALUES (1,'Hlavni sklad','Pruhonicka',10,'Praha',10000,123456789,'hlavni@sklad.cz'),(2,'Vedlejsi sklad','Brnenska',20,'Brno',60200,987654321,'vedlejsi@sklad.cz'),(3,'Sklad Ostrava','Ostravicka',30,'Ostrava',71000,111222333,'ostrava@sklad.cz'),(4,'Sklad Plzen','Plzenska',40,'Plzen',30100,444555666,'plzen@sklad.cz'),(5,'Sklad Liberec','Liberecka',50,'Liberec',46001,777888999,'liberec@sklad.cz');
/*!40000 ALTER TABLE `sklad` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-25 11:46:12
