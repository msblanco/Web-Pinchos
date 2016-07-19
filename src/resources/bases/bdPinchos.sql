-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP DATABASE IF EXISTS `pinchos`;

CREATE DATABASE `pinchos` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- creacion de usuario (dandole todos los privilegios)
GRANT USAGE ON *.* TO 'pinchos'@'localhost';
DROP USER 'pinchos'@'localhost';
CREATE USER 'pinchos'@'localhost' IDENTIFIED BY 'pinchos';
GRANT ALL PRIVILEGES ON `pinchos`.* TO 'pinchos'@'localhost' WITH GRANT OPTION;

-- todas las consultas posteriores pertenecen a la base de datos FLABOO
USE `pinchos`;

-- -----------------------------------------------------
-- All DROPs
-- -----------------------------------------------------

DROP TABLE IF EXISTS `concurso` ;
DROP TABLE IF EXISTS `usuario` ;
DROP TABLE IF EXISTS `participante` ;
DROP TABLE IF EXISTS `pincho` ;
DROP TABLE IF EXISTS `voto` ;
DROP TABLE IF EXISTS `premiados` ;
DROP TABLE IF EXISTS `codVoto` ;


-- -----------------------------------------------------
-- Table `concurso`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `concurso` (
  `idC` INT NOT NULL AUTO_INCREMENT,
  `nombreC` VARCHAR(45) NOT NULL,
  `basesC` VARCHAR(255) NOT NULL,
  `ciudadC` VARCHAR(45) NOT NULL,
  `fechaInicioC` VARCHAR(45) NOT NULL,
  `fechaFinalC` VARCHAR(45) NOT NULL,
  `fechaFinalistasC` VARCHAR(45) NOT NULL,
  `premioC` INT NOT NULL,
  `patrocinadorC` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `usuario` (
  `emailU` VARCHAR(45) NOT NULL,
  `contrasenaU` VARCHAR(45) NOT NULL,
  `tipoU` VARCHAR(1) NOT NULL comment 'J=Jurado popular, S=Jurado profesional, A=admiistador, P=participante',
  `estadoU` TINYINT(1) NOT NULL comment '1=activo, 0=incativo',
  `nombreU` VARCHAR(45) NOT NULL,
  `concursoId` INT,
  PRIMARY KEY (`emailU`),
  FOREIGN KEY (`concursoId`) REFERENCES `concurso` (`idC`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `participante`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `participante` (
  `direccionP` VARCHAR(45) NOT NULL,
  `telefonoP` INT NOT NULL,
  `nombreLocalP` VARCHAR(45) NOT NULL,
  `horarioP` VARCHAR(45) NOT NULL,
  `paginaWebP` VARCHAR(45) NOT NULL,
  `fotoP` VARCHAR(45) NOT NULL,
  `usuarioEmail` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`usuarioEmail`),
  FOREIGN KEY (`usuarioEmail`) REFERENCES `usuario` (`emailU`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `pincho`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `pincho` (
  `idPi` INT NOT NULL,
  `nombrePi` VARCHAR(45) NOT NULL,
  `precioPi` INT NOT NULL,
  `ingredientesPi` VARCHAR(255) NOT NULL,
  `cocineroPi` VARCHAR(45) NOT NULL,
  `numvotosPopPi` INT NOT NULL,
  `numvotosProfPi` DOUBLE NOT NULL,
  `fotoPi` VARCHAR(45) NOT NULL,
  `estadoPi` TINYINT(1) NOT NULL comment '1=activo, 0=inactivo',
  `participanteEmail` VARCHAR(45) NOT NULL,
  `numvotePi` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPi`),
  FOREIGN KEY (`participanteEmail`) REFERENCES `participante` (`usuarioEmail`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



  -- -----------------------------------------------------
  -- Table `codVoto`
  -- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `codVoto` (
  `idCV` VARCHAR(45) NOT NULL,
  `pinchoId` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idCV`, `pinchoId`),
  FOREIGN KEY (`pinchoId`) REFERENCES `pincho`(`idPi`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `premiados`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `premiados` (
  `idPrem` INT NOT NULL,
  `ronda` INT NOT NULL comment '0= ronda popular, 1=ronda profesional, 2=ronda premiados',
  PRIMARY KEY (`idPrem`),
  FOREIGN KEY (`idPrem`) REFERENCES `pincho`(`idPi`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `voto`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `voto` (
  `usuarioEmailU` VARCHAR(45) NOT NULL,
  `pinchoIdPi` INT NOT NULL,
  `codigoPinchoV` VARCHAR(45) NOT NULL,
  `valoracionV` INT NOT NULL,
  PRIMARY KEY (`usuarioEmailU`, `pinchoIdPi`, `codigoPinchoV`),
  FOREIGN KEY (`codigoPinchoV`) REFERENCES `codVoto` (`idCV`),
  FOREIGN KEY (`usuarioEmailU`) REFERENCES `usuario` (`emailU`),
  FOREIGN KEY (`pinchoIdPi`) REFERENCES `pincho` (`idPi`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


 -- -----------------------------------------------------
-- Datos de prueba
-- -----------------------------------------------------


INSERT INTO `concurso` (`idC`,`nombreC`, `basesC`, `ciudadC`, `fechaInicioC`, `fechaFinalC`, `fechaFinalistasC`, `premioC`, `patrocinadorC`) VALUES
('1','concurso Ourense', './resources/bases/bases.jpg', 'Ourense', '01/02/2015', '01/04/2015', '01/03/2015', '2000', 'sensei sonsoi SA');

INSERT INTO `usuario` (`emailU`, `contrasenaU`, `tipoU`, `estadoU`,`nombreU`,`concursoId`) VALUES
('jeni@gmail.com', 'jeni', 'A', '1','jeni vazquez rey','1'),
('adri@gmail.com', 'adri', 'J', '1', 'adrian gonzalez barbosa','1'),
('mel@gmail.com', 'mel', 'S', '1','melania sanchez blanco','1'),
('oscar@gmail.com', 'oscar', 'S', '1','oscar vazquez rey','1'),
('julian@gmail.com', 'julian', 'P', '1', 'julian gonzalez barbosa','1'),
('hector@gmail.com', 'hector', 'P', '1','hector sanchez blanco','1'),
('marta@gmail.com', 'julian', 'P', '1', 'marta gonzalez barbosa','1'),
('pablo@gmail.com', 'hector', 'P', '1','pablo sanchez blanco','1'),
('ruben@gmail.com', 'ruben', 'J', '1','ruben riande gil','1');

INSERT INTO `participante` (`direccionP`, `telefonoP`, `nombreLocalP`, `horarioP`,`paginaWebP`,`fotoP`,`usuarioEmail`) VALUES
('Ourense', '666666666', 'Escher', 'De 9:00 a 23:00','www.escher.es','09bdbbf9c288a3e2ebdc90a1615313a1','julian@gmail.com'),
('Vigo', '999999999', 'Graduado', 'De 9:00 a 23:00', 'www.graduado.es','d308bd4d2270681902ac20b02ce5df36','hector@gmail.com'),
('Madrid', '655555555', 'Flamingo', 'De 9:00 a 23:00','www.flaming.es','1c55b68e7477a0e0ff47c3b0ba23c0d6','marta@gmail.com'),
('Carballino', '633333333', 'Enxogo', 'De 9:00 a 23:00','www.enxogo.es','69c20c15cbe777332028b93499f9d4ab','pablo@gmail.com');

INSERT INTO `pincho` (`idPi`, `nombrePi`, `precioPi`, `ingredientesPi`,`cocineroPi`,`numvotosPopPi`,`numvotosProfPi`, `fotoPi`,`estadoPi`,`participanteEmail`, `numvotePi`) VALUES
('1', 'jamon', '1', 'patatas con huevos fritos','juan','2','0','./resources/img/pinchos/pincho.jpg','1','julian@gmail.com', '3'),
('2', 'queso', '2', 'solomillo al ajillo con pepinillo', 'pepe','2','3','./resources/img/pinchos2/pincho.jpg','1','hector@gmail.com', '4'),
('3', 'bacon', '3', 'salsa braba con caramelo gratinado en parmellano','carmen','2','4','./resources/img/pinchos/pincho3.jpg','1','marta@gmail.com', '4'),
('4', 'mortadela', '2', 'quesitos finos y variados','roberto','0','0','./resources/img/pinchos/pincho4.jpg','1','pablo@gmail.com', '0');

INSERT INTO `codVoto` (`idCV`, `pinchoId`) VALUES
('11', '1'),
('12', '1'),
('13','1'),
('14', '1'),
('15','1'),
('21', '2'),
('22', '2'),
('23','2'),
('24', '2'),
('25','2'),
('31', '3'),
('32','3'),
('33', '3'),
('34','3'),
('35', '3');

INSERT INTO `voto` (`usuarioEmailU`, `pinchoIdPi`, `codigopinchoV`, `valoracionV`) VALUES
('adri@gmail.com', '1', '11', '1'),
('adri@gmail.com', '2', '21', '0'),
('adri@gmail.com', '3', '31', '0'),
('ruben@gmail.com', '1', '12','0'),
('ruben@gmail.com', '2', '22','1'),
('ruben@gmail.com', '3', '32','0'),
('mel@gmail.com', '2', '23', '3'),
('mel@gmail.com', '3', '33', '4');
