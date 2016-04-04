CREATE TABLE IF NOT EXISTS `tbmunicipio_ibge` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `cdMicroregiao` INT UNSIGNED NOT NULL,
  `cdMunicipioCompleto` INT UNSIGNED NOT NULL,
  `qtPopulacao` INT NULL,
  `vlRendimentoMedioMensalUrbano` DECIMAL(10,2) NULL,
  `vlPib` DECIMAL(10,2) NULL,
  `vlPibPerCapita` DECIMAL(10,2) NULL,
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

CREATE TABLE IF NOT EXISTS `tbmunicipio_ibge_censorendimento` (
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
  CONSTRAINT `fk_tbmunicipio_ibge_censorendimento_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

