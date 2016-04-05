CREATE TABLE IF NOT EXISTS `tbsuf` (
  `cdUf` INT UNSIGNED NOT NULL,
  `stSigla` CHAR(2) NOT NULL,
  `stUf` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsmesoregiao` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMesoregiao` INT UNSIGNED NOT NULL,
  `stMesoregiao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMesoregiao`),
  CONSTRAINT `fk_tbsmesoregiao_tbsuf1`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbsuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsmicroregiao` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMesoregiao` INT UNSIGNED NOT NULL,
  `cdMicroregiao` INT UNSIGNED NOT NULL,
  `stMicroregiao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMicroregiao`),
  INDEX `tbsmicroregiao_cdMigroregiao` (`cdMicroregiao` ASC),
  INDEX `fk_tbsmicroregiao_tbsmesoregiao1_idx` (`cdUf` ASC, `cdMesoregiao` ASC),
  CONSTRAINT `fk_tbsmicroregiao_tbsmesoregiao1`
    FOREIGN KEY (`cdUf` , `cdMesoregiao`)
    REFERENCES `tbsmesoregiao` (`cdUf` , `cdMesoregiao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsmunicipio` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `cdMunicipioDv` TINYINT NOT NULL,
  `cdMicroregiao` INT UNSIGNED NOT NULL,
  `stMunicipio` VARCHAR(45) NOT NULL,
  `cdMunicipioCompleto` INT UNSIGNED NOT NULL,
  INDEX `fk_tbsmunicipio_tbsuf1_idx` (`cdUf` ASC),
  INDEX `fk_tbsmunicipio_tbsmicroregiao1_idx` (`cdMicroregiao` ASC),
  UNIQUE INDEX `un_cdMunicipioCompleto` (`cdMunicipioCompleto` ASC),
  PRIMARY KEY (`cdUf`, `cdMunicipio`),
  CONSTRAINT `fk_tbsmunicipio_tbsuf1`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbsuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbsmunicipio_tbsmicroregiao1`
    FOREIGN KEY (`cdMicroregiao`)
    REFERENCES `tbsmicroregiao` (`cdMicroregiao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsdistrito` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `cdDistrito` INT UNSIGNED NOT NULL,
  `stDistrito` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `cdDistrito`),
  INDEX `fk_tbsdistrito_tbsmunicipio1_idx` (`cdUf` ASC, `cdMunicipio` ASC),
  CONSTRAINT `fk_tbsdistrito_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbssubdistrito` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `cdDistrito` INT UNSIGNED NOT NULL,
  `cdSubdistrito` INT UNSIGNED NOT NULL,
  `stSubdistrito` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `cdDistrito`, `cdSubdistrito`),
  INDEX `fk_tbssubdistrito_tbsdistrito1_idx` (`cdUf` ASC, `cdMunicipio` ASC, `cdDistrito` ASC),
  CONSTRAINT `fk_tbssubdistrito_tbsdistrito1`
    FOREIGN KEY (`cdUf` , `cdMunicipio` , `cdDistrito`)
    REFERENCES `tbsdistrito` (`cdUf` , `cdMunicipio` , `cdDistrito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
