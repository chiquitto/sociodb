INSERT INTO `tbibgeuf` (cdUf, stUf, stSigla)
Select Distinct UF, Nome_UF, '--' Sigla From tbdtb;

Update tbibgeuf
Set stSigla = Case
When cdUf = 11 Then 'RO'
When cdUf = 12 Then 'AC'
When cdUf = 13 Then 'AM'
When cdUf = 14 Then 'RR'
When cdUf = 15 Then 'PA'
When cdUf = 16 Then 'AP'
When cdUf = 17 Then 'TO'
When cdUf = 21 Then 'MA'
When cdUf = 22 Then 'PI'
When cdUf = 23 Then 'CE'
When cdUf = 24 Then 'RN'
When cdUf = 25 Then 'PB'
When cdUf = 26 Then 'PE'
When cdUf = 27 Then 'AL'
When cdUf = 28 Then 'SE'
When cdUf = 29 Then 'BA'
When cdUf = 31 Then 'MG'
When cdUf = 32 Then 'ES'
When cdUf = 33 Then 'RJ'
When cdUf = 35 Then 'SP'
When cdUf = 41 Then 'PR'
When cdUf = 42 Then 'SC'
When cdUf = 43 Then 'RS'
When cdUf = 50 Then 'MS'
When cdUf = 51 Then 'MT'
When cdUf = 52 Then 'GO'
When cdUf = 53 Then 'DF'
End
Where (cdUf > 0);

INSERT INTO `tbibgemesoregiao` (`cdUf`, `cdMesoregiao`, `stMesoregiao`)
Select Distinct
UF,
Mesorregiao_Geografica,
Nome_Mesorregiao
From tbdtb
;

INSERT INTO `tbibgemicroregiao`
(`cdUf`, `cdMesoregiao`, `cdMicroregiao`, `stMicroregiao`)
Select Distinct
UF,
Mesorregiao_Geografica,
Microrregiao_Geografica,
Nome_Microrregiao
From tbdtb
;

INSERT INTO `tbibgemunicipio`
(`cdUf`, `cdMunicipio`, `cdMicroregiao`, `stMunicipio`, `cdMunicipioCompleto`)
Select Distinct
UF,
Municipio,
Microrregiao_Geografica,
Nome_Municipio,
Cod_Municipio_Completo
From tbdtb
;

INSERT INTO `tbibgedistrito`
(`cdUf`, `cdMunicipio`, `cdDistrito`, `stDistrito`)
Select Distinct
UF, Municipio, Distrito, Nome_Distrito
From tbdtb
;

INSERT INTO `tbibgesubdistrito`
(`cdUf`, `cdMunicipio`, `cdDistrito`, `cdSubdistrito`, `stSubdistrito`)
Select
UF, Municipio, Distrito, Subdistrito, Nome_Subdistrito
From tbdtb
Where Subdistrito > 0
;
