-- dtb = Distribuicao Territorial Brasileira

DROP TABLE IF EXISTS `tbdtb`;

CREATE TABLE `tbdtb` (
    UF int(11) NOT NULL,
    Nome_UF varchar(255) NOT NULL,
    Mesorregiao_Geografica int(11) NOT NULL,
    Nome_Mesorregiao varchar(255) NOT NULL,
    Microrregiao_Geografica int(11) NOT NULL,
    Nome_Microrregiao varchar(255) NOT NULL,
    Municipio int(11) NOT NULL,
    Cod_Municipio_Completo int(11) NOT NULL,
    Nome_Municipio varchar(255) NOT NULL,
    Distrito int(11) NOT NULL,
    Cod_Distrito_Completo int(11) NOT NULL,
    Nome_Distrito varchar(255) NOT NULL,
    Subdistrito int(11) NOT NULL,
    Cod_SubDistrito_Completo int(11) NOT NULL,
    Nome_Subdistrito varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
