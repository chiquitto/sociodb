CREATE TABLE IF NOT EXISTS `tbibgeuf` (
  `cdUf` INT NOT NULL,
  `stSigla` CHAR(2) NOT NULL,
  `stUf` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`))
ENGINE = InnoDB;

--separator

CREATE TABLE IF NOT EXISTS `tbibgemicroregiao` (
  `cdUf` INT NOT NULL,
  `cdMesoregiao` INT NOT NULL,
  `cdMicroregiao` INT NOT NULL,
  `stMicroregiao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMicroregiao`))
ENGINE = InnoDB;

--separator

CREATE TABLE IF NOT EXISTS `tbibgemunicipio` (
  `cdUf` INT NOT NULL,
  `cdMunicipio` INT NOT NULL COMMENT 'com DV',
  `cdMicroregiao` INT NOT NULL,
  `stMunicipio` VARCHAR(45) NOT NULL,
  `cdMunicipioCompleto` INT NOT NULL,
  `qtPopulacao` INT NULL,
  `vlRendimentoMedioMensalUrbano` DECIMAL(10,2) NULL,
  `vlPib` DECIMAL(10,2) NULL,
  `vlPibPerCapita` DECIMAL(10,2) NULL,
  INDEX `fk_tbibgemunicipio_tbibgeuf1_idx` (`cdUf` ASC),
  INDEX `fk_tbibgemunicipio_tbibgemicroregiao1_idx` (`cdMicroregiao` ASC),
  UNIQUE INDEX `un_cdMunicipioCompleto` (`cdMunicipioCompleto` ASC),
  PRIMARY KEY (`cdUf`, `cdMunicipio`),
  CONSTRAINT `fk_tbibgemunicipio_tbibgeuf1`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbibgeuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbibgemunicipio_tbibgemicroregiao1`
    FOREIGN KEY (`cdMicroregiao`)
    REFERENCES `tbibgemicroregiao` (`cdMicroregiao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--separator

CREATE TABLE IF NOT EXISTS `tbibgemesoregiao` (
  `cdUf` INT NOT NULL,
  `cdMesoregiao` INT NOT NULL,
  `stMesoregiao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMesoregiao`),
  CONSTRAINT `fk_tbibgemesoregiao_tbibgeuf1`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbibgeuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbibgemesoregiao_tbibgemicroregiao1`
    FOREIGN KEY (`cdUf` , `cdMesoregiao`)
    REFERENCES `tbibgemicroregiao` (`cdUf` , `cdMesoregiao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--separator

CREATE TABLE IF NOT EXISTS `tbibgedistrito` (
  `cdUf` INT NOT NULL,
  `cdMunicipio` INT NOT NULL,
  `cdDistrito` INT NOT NULL,
  `stDistrito` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `cdDistrito`),
  INDEX `fk_tbibgedistrito_tbibgemunicipio1_idx` (`cdUf` ASC, `cdMunicipio` ASC),
  CONSTRAINT `fk_tbibgedistrito_tbibgemunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbibgemunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--separator

CREATE TABLE IF NOT EXISTS `tbibgesubdistrito` (
  `cdUf` INT NOT NULL,
  `cdMunicipio` INT NOT NULL,
  `cdDistrito` INT NOT NULL,
  `cdSubdistrito` INT NOT NULL,
  `stSubdistrito` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `cdDistrito`, `cdSubdistrito`),
  INDEX `fk_tbibgesubdistrito_tbibgedistrito1_idx` (`cdUf` ASC, `cdMunicipio` ASC, `cdDistrito` ASC),
  CONSTRAINT `fk_tbibgesubdistrito_tbibgedistrito1`
    FOREIGN KEY (`cdUf` , `cdMunicipio` , `cdDistrito`)
    REFERENCES `tbibgedistrito` (`cdUf` , `cdMunicipio` , `cdDistrito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--separator

CREATE TABLE IF NOT EXISTS `tbibgecensorendimento` (
  `cd` INT NOT NULL,
  `semrenda` INT NOT NULL,
  `atemeio` INT NOT NULL,
  `entremeioe1` INT NOT NULL,
  `entre1e2` INT NOT NULL,
  `entre2e5` INT NOT NULL,
  `entre5e10` INT NOT NULL,
  `entre10e20` INT NOT NULL,
  `mais20` INT NOT NULL,
  PRIMARY KEY (`cd`))
ENGINE = InnoDB;
