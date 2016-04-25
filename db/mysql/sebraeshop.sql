CREATE TABLE IF NOT EXISTS `tbsebraeshop_uf` (
  `cdUf` INT UNSIGNED NOT NULL,
  `nrAno` YEAR NOT NULL,
  `qtPopulacao` INT NULL,
  `qtDomiciliosTotal` INT NULL,
  `qtDomiciliosA1` INT NULL,
  `qtDomiciliosA2` INT NULL,
  `qtDomiciliosB1` INT NULL,
  `qtDomiciliosB2` INT NULL,
  `qtDomiciliosC1` INT NULL,
  `qtDomiciliosC2` INT NULL,
  `qtDomiciliosD` INT NULL,
  `qtDomiciliosE` INT NULL,
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
