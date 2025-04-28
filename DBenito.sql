-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: administrador
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL AUTO_INCREMENT,
  `nombrecategoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Alimentos'),(2,'Bebidas'),(3,'Lácteos'),(4,'Carnes y Aves'),(5,'Verduras'),(6,'Frutas'),(7,'Panadería'),(8,'Limpieza'),(9,'Aseo Personal'),(10,'Mascotas'),(11,'Papelería'),(12,'Suministros Médicos'),(13,'Snacks');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallespedido`
--

DROP TABLE IF EXISTS `detallespedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallespedido` (
  `idpedido` int NOT NULL,
  `idproducto` int NOT NULL,
  `nombreproducto` varchar(150) DEFAULT NULL,
  `preciooriginal` decimal(6,2) DEFAULT NULL,
  `porcentajedescuento` decimal(6,2) DEFAULT NULL,
  `preciodescuento` decimal(6,2) DEFAULT NULL,
  `calificacion` int DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `proveedor` varchar(50) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  KEY `idpedido` (`idpedido`),
  KEY `idproducto` (`idproducto`),
  CONSTRAINT `detallespedido_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  CONSTRAINT `detallespedido_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  CONSTRAINT `detallespedido_chk_1` CHECK ((`calificacion` between 1 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallespedido`
--

LOCK TABLES `detallespedido` WRITE;
/*!40000 ALTER TABLE `detallespedido` DISABLE KEYS */;
INSERT INTO `detallespedido` VALUES (2,10,'Sprite 500ml',2.50,20.00,2.00,4,'Bebidas','Proveedores del Centro',1),(3,3,'Arroz Faraon Añejo Extra A Granel X Kg',4.80,4.00,4.61,4,'Alimentos','Distribuidora Andina',6),(3,2,'Caserita Arroz Extra A Granel X Kg',3.80,5.00,3.61,3,'Alimentos','Central de Abarrotes',3),(5,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2),(6,6,'La Siembra Arroz Extra Añejo Bolsa X 1 Kg',5.40,7.50,5.00,5,'Alimentos','Distribuciones del Sur',2),(6,7,'Huevos Rosados A Granel X Kg',8.90,5.00,8.46,5,'Alimentos','Distribuidora Andina',1),(6,8,'Pepsi 500ml',2.50,15.00,2.13,5,'Bebidas','Alicorp',1),(7,1,'Pacasmayo Arroz Extra A Granel X Kg',4.40,20.00,3.52,4,'Alimentos','Distribuidora Andina',4);
/*!40000 ALTER TABLE `detallespedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `idpedido` int NOT NULL AUTO_INCREMENT,
  `idusuario` int DEFAULT NULL,
  `total` decimal(6,2) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `totalproductos` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  CONSTRAINT `pedido_chk_1` CHECK ((`estado` between 0 and 3))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,1,NULL,0,NULL,NULL),(2,2,2.00,1,1,'2024-12-03 14:03:38'),(3,2,38.49,1,9,'2024-12-03 14:13:05'),(4,2,NULL,0,NULL,NULL),(5,3,NULL,0,2,NULL),(6,4,20.59,3,4,'2024-12-11 14:06:52'),(7,4,14.08,1,4,'2024-12-11 14:10:48'),(8,4,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `idproducto` int NOT NULL AUTO_INCREMENT,
  `idcategoria` int DEFAULT NULL,
  `idproveedor` int DEFAULT NULL,
  `nombreproducto` varchar(150) DEFAULT NULL,
  `enlace` varchar(400) DEFAULT NULL,
  `preciooriginal` decimal(6,2) DEFAULT NULL,
  `porcentajedescuento` decimal(6,2) DEFAULT NULL,
  `preciodescuento` decimal(6,2) DEFAULT NULL,
  `calificacion` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idproveedor` (`idproveedor`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`),
  CONSTRAINT `producto_chk_1` CHECK ((`calificacion` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,1,2,'Pacasmayo Arroz Extra A Granel X Kg','https://corporacionliderperu.com/50111-large_default/pacasmayo-arroz-extra-a-granel-x-kg-exo-igv.jpg',4.40,20.00,3.52,4,16),(2,1,4,'Caserita Arroz Extra A Granel X Kg','https://corporacionliderperu.com/50113-large_default/caserita-arroz-extra-a-granel-x-kg-exo-igv.jpg',3.80,0.00,3.80,3,7),(3,1,2,'Arroz Faraon Añejo Extra A Granel X Kg','https://corporacionliderperu.com/50112-large_default/arroz-faraon-anejo-extra-a-granel-x-kg-exo-igv.jpg',4.80,4.00,4.61,4,9),(4,1,5,'Arroz Paisana Integral X 1 Kg. ','https://corporacionliderperu.com/50462-large_default/arroz-paisana-integral-x-1-kg-exo-igv.jpg',5.90,5.00,5.61,5,12),(5,1,5,'Valle Norte Arroz Extra X 750 Gr.','https://corporacionliderperu.com/48387-large_default/valle-norte-arroz-extra-x-750-gr-exo-igv.jpg',4.20,0.00,4.20,4,15),(6,1,8,'La Siembra Arroz Extra Añejo Bolsa X 1 Kg','https://corporacionliderperu.com/47198-large_default/la-siembra-arroz-extra-anejo-bolsa-x-1-kg-exo-igv.jpg',5.40,7.50,5.00,5,8),(7,1,2,'Huevos Rosados A Granel X Kg','https://corporacionliderperu.com/45609-large_default/huevos-rosados-a-granel-x-kg.jpg',8.90,5.00,8.46,5,99),(8,2,6,'Pepsi 500ml','https://media.freshmart.pe/products/81203.png',2.50,15.00,2.13,5,24),(9,2,8,'Inca Kola 1L','https://plazavea.vteximg.com.br/arquivos/ids/28516733-220-220/20111231.jpg?v=638374467426630000',3.50,5.00,3.33,4,20),(10,2,7,'Sprite 500ml','https://wongfood.vtexassets.com/arquivos/ids/694304-800-auto?v=638458833872900000&width=800&height=auto&aspect=true',2.50,0.00,2.50,4,39),(11,2,3,'Fanta 500ml','https://wongfood.vtexassets.com/arquivos/ids/694305-800-auto?v=638458833875700000&width=800&height=auto&aspect=true',2.50,0.00,2.50,3,20);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor` (
  `idproveedor` int NOT NULL AUTO_INCREMENT,
  `nombreprov` varchar(50) DEFAULT NULL,
  `direccionprov` varchar(60) DEFAULT NULL,
  `telefonoprov` int DEFAULT NULL,
  `emailprov` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`),
  CONSTRAINT `proveedor_chk_1` CHECK ((`telefonoprov` between 900000000 and 999999999))
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'Abarrotes San Jorge','Av. Perú 1234, Lima',912345678,'contacto@sanjorge.com'),(2,'Distribuidora Andina','Jr. Los Andes 5678, Cusco',923456789,'info@andina.com'),(3,'Productos del Norte','Calle Comercio 2345, Trujillo',934567890,'ventas@norte.com'),(4,'Central de Abarrotes','Av. Central 3456, Arequipa',945678901,'contacto@central.com'),(5,'Abarrotes del Valle','Av. Valle 5678, Chiclayo',967890123,'ventas@valle.com'),(6,'Alicorp','Av. Nicolás Ayllón 4986, Lima',981234567,'contacto@alicorp.com'),(7,'Proveedores del Centro','Calle Centro 6789, Huancayo',978901234,'contacto@centro.com'),(8,'Distribuciones del Sur','Av. Sur 7890, Ica',989012345,'info@surdist.com'),(9,'Abarrotes y Más','Jr. Más 8901, Piura',900123456,'ventas@abymas.com'),(10,'Productos Selectos','Av. Selecta 9012, Puno',901234567,'contacto@selectos.com'),(11,'Umsha','Av. Perú 1234, Lima',963852784,'contacto@umsha.com');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `idrol` int NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Cliente'),(3,'Empleado');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `idrol` int DEFAULT NULL,
  `nombreusuario` varchar(100) DEFAULT NULL,
  `correousuario` varchar(80) DEFAULT NULL,
  `telefonousuario` int DEFAULT NULL,
  `direccionusuario` varchar(150) DEFAULT NULL,
  `usuario` varchar(80) DEFAULT NULL,
  `contrasena` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idrol` (`idrol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`),
  CONSTRAINT `usuario_chk_1` CHECK ((`telefonousuario` between 900000000 and 999999999))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES 
(1,1,'Tomás Eduardo Olaya Purizaca','olayapurizacatomaseduardo@gmail.com',936251840,'Los Capulies Ñ14 Urb. Miraflores','tomasola','$2y$10$ntQQUx6h1D7dFaxtmgse5O5y/3d5c063J0s5EefPBONc3xjMtjF7.'),(2,3,'Noe Eche Maza','panchito21@gmail.com',957866321,'Av. Grau 205','panchito23','$2y$10$d4zpCCzYA7CMDutTVC Nd.eDAgeJlQ1gIvGar.BndiHhcaMAgEN5xO'),(3,2,'Pedro','anlucia2007@gmail.com',957866321,'Av. Grau 205','pedro','$2y$10$GkYFb.9dnfsvplF43yRVEu4BKIsRn44LtXHcgdOh5bsJeIvbd0yjW'),(4,2,'Fernanda','fernanda@gmail.com',953628741,'Los canarios','fernanda','$2y$10$H.nqKY3.DRVtnXJ2ZIHjIOlGLLAR8Art.2I5KlJwhGpHLGhGPGoBy');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-21 15:40:24
