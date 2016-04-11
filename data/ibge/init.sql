Delete From tbibge_municipio;

Insert Into tbibge_municipio (cdUf, cdMunicipio, cdMicroregiao, cdMunicipioCompleto)
Select cdUf, cdMunicipio, cdMicroregiao, cdMunicipioCompleto From tbsmunicipio;

Insert Into tbibge_uf (cdUf)
Select cdUf From tbsuf;
