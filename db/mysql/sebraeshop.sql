CREATE TABLE IF NOT EXISTS `tbsebraeshop_uf` (
  `cdUf` INT UNSIGNED NOT NULL,
  `nrAno` YEAR NOT NULL,
  `qtPopulacaoRural` INT NULL,
  `qtPopulacaoUrbana` INT NULL,
  `qtPopulacao` INT NULL,
  `qtDomiciliosRuralTotal` INT NULL COMMENT '	',
  `qtDomiciliosUrbanaTotal` INT NULL,
  `qtDomiciliosUrbanaA1` INT NULL,
  `qtDomiciliosUrbanaA2` INT NULL,
  `qtDomiciliosUrbanaB1` INT NULL,
  `qtDomiciliosUrbanaB2` INT NULL,
  `qtDomiciliosUrbanaC1` INT NULL,
  `qtDomiciliosUrbanaC2` INT NULL,
  `qtDomiciliosUrbanaD` INT NULL,
  `qtDomiciliosUrbanaE` INT NULL,
  PRIMARY KEY (`cdUf`, `nrAno`),
  CONSTRAINT `fk_tbibge_uf_tbsebraeshop_uf`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbsuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsebraeshop_uf_consumo` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdCategoria` INT NOT NULL,
  `nrAno` YEAR NOT NULL,
  `varTotal` DECIMAL(15,2) NULL,
  `varA1` DECIMAL(15,2) NULL,
  `varA2` DECIMAL(15,2) NULL,
  `varB1` DECIMAL(15,2) NULL,
  `varB2` DECIMAL(15,2) NULL,
  `varC1` DECIMAL(15,2) NULL,
  `varC2` DECIMAL(15,2) NULL,
  `varD` DECIMAL(15,2) NULL,
  `varE` DECIMAL(15,2) NULL,
  PRIMARY KEY (`cdUf`, `cdCategoria`, `nrAno`),
  CONSTRAINT `fk_tbsebraeshop_uf_consumo_tbsuf1`
    FOREIGN KEY (`cdUf`)
    REFERENCES `tbsuf` (`cdUf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsebraeshop_municipio` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `nrAno` YEAR NOT NULL,
  `qtPopulacaoRural` INT NULL,
  `qtPopulacaoUrbana` INT NULL,
  `qtPopulacao` INT NULL,
  `qtDomiciliosRuralTotal` INT NULL COMMENT '	',
  `qtDomiciliosUrbanaTotal` INT NULL,
  `qtDomiciliosUrbanaA1` INT NULL,
  `qtDomiciliosUrbanaA2` INT NULL,
  `qtDomiciliosUrbanaB1` INT NULL,
  `qtDomiciliosUrbanaB2` INT NULL,
  `qtDomiciliosUrbanaC1` INT NULL,
  `qtDomiciliosUrbanaC2` INT NULL,
  `qtDomiciliosUrbanaD` INT NULL,
  `qtDomiciliosUrbanaE` INT NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `nrAno`),
  INDEX `fk_tbsebraeshop_municipio_tbsmunicipio1_idx` (`cdUf` ASC, `cdMunicipio` ASC),
  CONSTRAINT `fk_tbsebraeshop_municipio_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tbsebraeshop_municipio_consumo` (
  `cdUf` INT UNSIGNED NOT NULL,
  `cdMunicipio` INT UNSIGNED NOT NULL,
  `cdCategoria` INT NOT NULL,
  `nrAno` YEAR NOT NULL,
  `varTotal` DECIMAL(15,2) NULL,
  `varA1` DECIMAL(15,2) NULL,
  `varA2` DECIMAL(15,2) NULL,
  `varB1` DECIMAL(15,2) NULL,
  `varB2` DECIMAL(15,2) NULL,
  `varC1` DECIMAL(15,2) NULL,
  `varC2` DECIMAL(15,2) NULL,
  `varD` DECIMAL(15,2) NULL,
  `varE` DECIMAL(15,2) NULL,
  PRIMARY KEY (`cdUf`, `cdMunicipio`, `cdCategoria`, `nrAno`),
  INDEX `fk_tbsebraeshop_municipio_consumo_tbsmunicipio1_idx` (`cdUf` ASC, `cdMunicipio` ASC),
  CONSTRAINT `fk_tbsebraeshop_municipio_consumo_tbsmunicipio1`
    FOREIGN KEY (`cdUf` , `cdMunicipio`)
    REFERENCES `tbsmunicipio` (`cdUf` , `cdMunicipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
