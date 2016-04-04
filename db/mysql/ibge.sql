CREATE TABLE IF NOT EXISTS `tbmunicipio_ibge` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL COMMENT 'com DV',
  `cdMicroregiao` INT UNSIGNED NOT NULL,
  `cdMunicipioCompleto` INT UNSIGNED NOT NULL,
  `qtPopulacao` INT NULL,
  `vlRendimentoMedioMensalUrbano` DECIMAL(10,2) NULL,
  `vlPib` DECIMAL(10,2) NULL,
  `vlPibPerCapita` DECIMAL(10,2) NULL,
  INDEX `fk_tbsmunicipio_tbsuf1_idx` (`cdUf` ASC),
  INDEX `fk_tbsmunicipio_tbsmicroregiao1_idx` (`cdMicroregiao` ASC),
  UNIQUE INDEX `un_cdMunicipioCompleto` (`cdMunicipioCompleto` ASC),
  PRIMARY KEY (`cdUf`, `cdMunicipio`),
  CONSTRAINT `fk_tbsmunicipio_tbsuf10`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbsuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbsmunicipio_tbsmicroregiao10`
    FOREIGN KEY (`cdMicroregiao`)
    REFERENCES `tbsmicroregiao` (`cdMicroregiao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

