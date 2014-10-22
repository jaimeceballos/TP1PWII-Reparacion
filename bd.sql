CREATE DATABASE  IF NOT EXISTS `proyectoBD` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `proyectoBD`;
-- MySQL dump 10.13  Distrib 5.6.19, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: proyectoBD
-- ------------------------------------------------------
-- Server version	5.6.19-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `persona_id` int(10) unsigned NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_cliente_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_cliente_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,2,1),(2,4,1),(3,5,1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposito`
--

DROP TABLE IF EXISTS `deposito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposito` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipo_id` int(10) unsigned NOT NULL,
  `orden_trabajo_id` int(10) unsigned NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_egreso` date DEFAULT NULL,
  `causa_egreso` text,
  `depositocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_deposito_equipo1_idx` (`equipo_id`),
  KEY `fk_deposito_orden_trabajo1_idx` (`orden_trabajo_id`),
  CONSTRAINT `fk_deposito_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_deposito_orden_trabajo1` FOREIGN KEY (`orden_trabajo_id`) REFERENCES `orden_trabajo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposito`
--

LOCK TABLES `deposito` WRITE;
/*!40000 ALTER TABLE `deposito` DISABLE KEYS */;
INSERT INTO `deposito` VALUES (2,1,1,'2014-10-16 19:51:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `deposito` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `proyectoBD`.`deposito_BEFORE_UPDATE` BEFORE UPDATE ON `deposito` FOR EACH ROW
    begin
		if NEW.fecha_egreso is not null then
			if NEW.causa_egreso is null or NEW.causa_egreso = "" or length(NEW.causa_egreso)<10 then
				signal sqlstate '45000' set message_text = "Debe indicar Causa de egreso del deposito.";
			end if;
		else
			signal sqlstate '45000' set message_text = "Debe indicar fecha de egreso del equipo.";
		end if;
    
    end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `persona_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empleado_persona_idx` (`persona_id`),
  CONSTRAINT `fk_empleado_persona` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_equipo_id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `descripcion_equipo` text NOT NULL,
  `estado_general` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipo_tipo_equipo1_idx` (`tipo_equipo_id`),
  KEY `fk_equipo_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_equipo_tipo_equipo1` FOREIGN KEY (`tipo_equipo_id`) REFERENCES `tipo_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES (1,1,1,'pc todo en uno marca hp','carcaza marcada en una esquina'),(2,1,3,'ASDASD','asdfasdf'),(3,1,2,'tablet','bueno');
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo_orden_trabajo`
--

DROP TABLE IF EXISTS `equipo_orden_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo_orden_trabajo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipo_id` int(10) unsigned NOT NULL,
  `orden_trabajo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipo_has_orden_trabajo_orden_trabajo1_idx` (`orden_trabajo_id`),
  KEY `fk_equipo_has_orden_trabajo_equipo1_idx` (`equipo_id`),
  CONSTRAINT `fk_equipo_has_orden_trabajo_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_has_orden_trabajo_orden_trabajo1` FOREIGN KEY (`orden_trabajo_id`) REFERENCES `orden_trabajo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo_orden_trabajo`
--

LOCK TABLES `equipo_orden_trabajo` WRITE;
/*!40000 ALTER TABLE `equipo_orden_trabajo` DISABLE KEYS */;
INSERT INTO `equipo_orden_trabajo` VALUES (1,1,1);
/*!40000 ALTER TABLE `equipo_orden_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `equipos_en_deposito`
--

DROP TABLE IF EXISTS `equipos_en_deposito`;
/*!50001 DROP VIEW IF EXISTS `equipos_en_deposito`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `equipos_en_deposito` AS SELECT 
 1 AS `equipo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `no_retirados`
--

DROP TABLE IF EXISTS `no_retirados`;
/*!50001 DROP VIEW IF EXISTS `no_retirados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `no_retirados` AS SELECT 
 1 AS `id`,
 1 AS `nro_orden`,
 1 AS `propietario`,
 1 AS `fecha entrada`,
 1 AS `finalizado`,
 1 AS `falla`,
 1 AS `dias`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `orden_trabajo`
--

DROP TABLE IF EXISTS `orden_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_trabajo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empleado_id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `tipo_orden_id` int(10) unsigned NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `descripcion_falla` text NOT NULL,
  `trabajo_realizado` text,
  `fecha_finalizado` datetime DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `importe_trabajo` decimal(9,2) DEFAULT NULL,
  `nro_factura` varchar(45) DEFAULT NULL,
  `remito_entrega` varchar(45) DEFAULT NULL,
  `presupuestado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_orden_trabajo_empleado1_idx` (`empleado_id`),
  KEY `fk_orden_trabajo_cliente1_idx` (`cliente_id`),
  KEY `fk_orden_trabajo_tipo_orden1_idx` (`tipo_orden_id`),
  CONSTRAINT `fk_orden_trabajo_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_trabajo_empleado1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_trabajo_tipo_orden1` FOREIGN KEY (`tipo_orden_id`) REFERENCES `tipo_orden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_trabajo`
--

LOCK TABLES `orden_trabajo` WRITE;
/*!40000 ALTER TABLE `orden_trabajo` DISABLE KEYS */;
INSERT INTO `orden_trabajo` VALUES (1,1,1,1,'2014-08-13 17:00:00','no enciende','reinstalacion SO','2014-08-15 18:00:00',NULL,300.00,NULL,NULL,0);
/*!40000 ALTER TABLE `orden_trabajo` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `orden_trabajo` BEFORE INSERT ON `orden_trabajo` FOR EACH ROW
begin
	if NEW.fecha_entrada is null or NEW.fecha_entrada = "" then
		signal sqlstate '45000' set message_text = "Debe indicar fecha de entrada del equipo.";
	end if;
	if NEW.descripcion_falla is null or NEW.descripcion_falla = "" or length(NEW.descripcion_falla)<4 then
		signal sqlstate '45000' set message_text = "Debe describir la falla por la que ingresa el equipo.";
	end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `ordenes_pendientes`
--

DROP TABLE IF EXISTS `ordenes_pendientes`;
/*!50001 DROP VIEW IF EXISTS `ordenes_pendientes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ordenes_pendientes` AS SELECT 
 1 AS `nro orden`,
 1 AS `empleado`,
 1 AS `fecha entrada`,
 1 AS `falla`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ape_nom` varchar(100) NOT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `domicilio` text NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `juridica` tinyint(1) DEFAULT '0',
  `cuit` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ape_nom_UNIQUE` (`ape_nom`),
  UNIQUE KEY `ape_docu` (`ape_nom`,`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'jaime ceballos','29260319','facundo quiroga 113',NULL,NULL,0,NULL),(2,'inmobiliaria de felice',NULL,'conesa 254','2804270233','jcserviciosinf@gmail.com',1,'20123456784'),(4,'Romina Leguizamon','32568680','facundo quiroga 113','','',0,''),(5,'bomberos rawson','','conesa y pueyrredon','','',1,'20123456784');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `proyectoBD`.`persona_BEFORE_INSERT` BEFORE INSERT ON `persona` FOR EACH ROW
begin
  declare msg varchar(255);
  if NEW.juridica then
   if NEW.cuit is null or NEW.cuit = "" or length(NEW.cuit) < 10 then 
	signal sqlstate '45000' set message_text = "No ingreso numero de CUIT para la persona Juridica";
   end if;
  else 
   if NEW.dni is null or NEW.dni = "" or length(NEW.dni) < 7 then 
	signal sqlstate '45000' set message_text = "No ingreso numero de DNI para la persona";
   end if;
  end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tipo_equipo`
--

DROP TABLE IF EXISTS `tipo_equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_equipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_equipo`
--

LOCK TABLES `tipo_equipo` WRITE;
/*!40000 ALTER TABLE `tipo_equipo` DISABLE KEYS */;
INSERT INTO `tipo_equipo` VALUES (1,'PC');
/*!40000 ALTER TABLE `tipo_equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_orden`
--

DROP TABLE IF EXISTS `tipo_orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_orden` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_orden`
--

LOCK TABLES `tipo_orden` WRITE;
/*!40000 ALTER TABLE `tipo_orden` DISABLE KEYS */;
INSERT INTO `tipo_orden` VALUES (1,'presupuesto'),(2,'reparacion');
/*!40000 ALTER TABLE `tipo_orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `pass` text NOT NULL,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'jaime','e10adc3949ba59abbe56e057f20f883e','empleado'),(2,'jperez','e10adc3949ba59abbe56e057f20f883e','cliente');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `usuario_BINS` BEFORE INSERT ON `usuario` FOR EACH ROW
begin
	declare pass_md5 text;
	set pass_md5 := md5(NEW.pass);
	set NEW.pass := pass_md5;
	if length(NEW.user)<3 and length(NEW.user)>10 then
		signal sqlstate '45000' set message_text = "Usuario debe tener entre 3 y 10 caracteres";
	end if;
	if NEW.rol != 'cliente' or NEW.rol !='empleado' then
		signal sqlstate '45000' set message_text = "No ingreso un rol valido";
	end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping routines for database 'proyectoBD'
--
/*!50003 DROP FUNCTION IF EXISTS `calcular_tiempo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_tiempo`(fecha date) RETURNS int(11)
BEGIN
	declare tiempo int;
	select datediff(current_date(),fecha) into tiempo;
RETURN tiempo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `equipo_deposito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `equipo_deposito`(empleado int)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
	BEGIN
		ROLLBACK;
	END;
	insert into deposito(equipo_id,orden_trabajo) select id,nro_orden from no_retirados;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `equipos_en_deposito`
--

/*!50001 DROP VIEW IF EXISTS `equipos_en_deposito`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `equipos_en_deposito` AS select `deposito`.`equipo_id` AS `equipo` from `deposito` where isnull(`deposito`.`fecha_egreso`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `no_retirados`
--

/*!50001 DROP VIEW IF EXISTS `no_retirados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `no_retirados` AS select `eq`.`id` AS `id`,`ot`.`id` AS `nro_orden`,`p`.`ape_nom` AS `propietario`,`ot`.`fecha_entrada` AS `fecha entrada`,`ot`.`fecha_finalizado` AS `finalizado`,`ot`.`descripcion_falla` AS `falla`,`calcular_tiempo`(`ot`.`fecha_finalizado`) AS `dias` from ((((`orden_trabajo` `ot` join `cliente` `c` on((`ot`.`cliente_id` = `c`.`id`))) join `persona` `p` on((`c`.`persona_id` = `p`.`id`))) join `equipo_orden_trabajo` `eot` on((`eot`.`orden_trabajo_id` = `ot`.`id`))) join `equipo` `eq` on((`eq`.`id` = `eot`.`equipo_id`))) where ((`ot`.`fecha_finalizado` is not null) and isnull(`ot`.`fecha_salida`) and (`calcular_tiempo`(`ot`.`fecha_finalizado`) > 60) and (not(`eq`.`id` in (select `equipos_en_deposito`.`equipo` from `equipos_en_deposito`)))) union select `eq`.`id` AS `id`,`ot`.`id` AS `nro_orden`,`p`.`ape_nom` AS `propietario`,`ot`.`fecha_entrada` AS `fecha entrada`,`ot`.`fecha_finalizado` AS `finalizado`,`ot`.`descripcion_falla` AS `falla`,`calcular_tiempo`(`ot`.`fecha_finalizado`) AS `dias` from ((((`orden_trabajo` `ot` join `cliente` `c` on((`ot`.`cliente_id` = `c`.`id`))) join `persona` `p` on((`c`.`persona_id` = `p`.`id`))) join `equipo_orden_trabajo` `eot` on((`eot`.`orden_trabajo_id` = `ot`.`id`))) join `equipo` `eq` on((`eq`.`id` = `eot`.`equipo_id`))) where (isnull(`ot`.`fecha_finalizado`) and (`ot`.`presupuestado` is true) and (`calcular_tiempo`(`ot`.`fecha_entrada`) > 60) and (not(`eq`.`id` in (select `equipos_en_deposito`.`equipo` from `equipos_en_deposito`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ordenes_pendientes`
--

/*!50001 DROP VIEW IF EXISTS `ordenes_pendientes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ordenes_pendientes` AS select `ot`.`id` AS `nro orden`,`p`.`ape_nom` AS `empleado`,`ot`.`fecha_entrada` AS `fecha entrada`,`ot`.`descripcion_falla` AS `falla` from ((`orden_trabajo` `ot` join `empleado` `e` on((`ot`.`empleado_id` = `e`.`id`))) join `persona` `p` on((`e`.`persona_id` = `p`.`id`))) where isnull(`ot`.`fecha_finalizado`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-22 17:30:31
