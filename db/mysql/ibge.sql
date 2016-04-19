CREATE TABLE IF NOT EXISTS `tbibge_municipio` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `cdMicroregiao` INT UNSIGNED NOT NULL,
  `cdMunicipioCompleto` INT UNSIGNED NOT NULL,
  `vlArea` DECIMAL(9,3) NULL,
  `qtPopulacao2015` INT NULL,
  `vlDensidadeDemografica2015` DECIMAL(7,2) NULL,
  `vlRendimentoMedioMensalUrbano2010` DECIMAL(10,2) NULL,
  INDEX `fk_tbsmunicipio_tbsmicroregiao1_idx` (`cdMicroregiao` ASC),
  UNIQUE INDEX `un_cdMunicipioCompleto` (`cdMunicipioCompleto` ASC),
  PRIMARY KEY (`cdUf`, `cdMunicipio`),
  CONSTRAINT `fk_tbsmunicipio_tbsmicroregiao10`
    FOREIGN KEY (`cdMicroregiao`)
    REFERENCES `tbsmicroregiao` (`cdMicroregiao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbmunicipio_ibge_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbibge_censo_rendimento` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `semrenda` INT NOT NULL,
  `atemeio` INT NOT NULL,
  `entremeioe1` INT NOT NULL,
  `entre1e2` INT NOT NULL,
  `entre2e5` INT NOT NULL,
  `entre5e10` INT NOT NULL,
  `entre10e20` INT NOT NULL,
  `mais20` INT NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`),
  CONSTRAINT `fk_tbibge_municipio_censorendimento_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbibge_pib_municipio` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `nrAno` YEAR NOT NULL,
  `vlPib` DECIMAL(18,3) UNSIGNED NOT NULL,
  `qtPopulacao` INT UNSIGNED NOT NULL,
  `vlPibCapita` DECIMAL(18,2) UNSIGNED NOT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `nrAno`),
  CONSTRAINT `fk_tbibge_pib_municipio_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbibge_uf` (
  `cdUf` INT UNSIGNED NOT NULL,
  `qtPopulacao2015` INT NULL,
  PRIMARY KEY (`cdUf`),
  CONSTRAINT `fk_tbibge_uf_tbsuf1`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbsuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
