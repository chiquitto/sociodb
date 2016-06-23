-- dtb = Distribuicao Territorial Brasileira

DROP TABLE IF EXISTS `tbdtb`;

CREATE TABLE `tbdtb` (
    UF BIGINT NOT NULL,
    Nome_UF varchar(255) NOT NULL,
    Mesorregiao_Geografica BIGINT NOT NULL,
    Nome_Mesorregiao varchar(255) NOT NULL,
    Microrregiao_Geografica BIGINT NOT NULL,
    Nome_Microrregiao varchar(255) NOT NULL,
    Municipio BIGINT NOT NULL,
    Cod_Municipio_Completo BIGINT Unsigned NOT NULL,
    Nome_Municipio varchar(255) NOT NULL,
    Distrito BIGINT NOT NULL,
    Cod_Distrito_Completo BIGINT Unsigned NOT NULL,
    Nome_Distrito varchar(255) NOT NULL,
    Subdistrito BIGINT NOT NULL,
    Cod_SubDistrito_Completo BIGINT Unsigned NOT NULL,
    Nome_Subdistrito varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
