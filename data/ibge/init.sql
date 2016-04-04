Delete From tbmunicipio_ibge;

INSERT INTO tbmunicipio_ibge (cdUf, cdMunicipio, cdMicroregiao, cdMunicipioCompleto)
Select cdUf, cdMunicipio, cdMicroregiao, cdMunicipioCompleto From tbsmunicipio;