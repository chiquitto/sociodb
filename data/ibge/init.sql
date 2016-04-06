Delete From tbibge_municipio;

INSERT INTO tbibge_municipio (cdUf, cdMunicipio, cdMicroregiao, cdMunicipioCompleto)
Select cdUf, cdMunicipio, cdMicroregiao, cdMunicipioCompleto From tbsmunicipio;