<?php

namespace Chiquitto\Sociodb\Action\Sebraeshop;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;

/**
 * SQL para verificar tbsebraeshop_municipio
 * Select
m.cdMunicipioCompleto,
m.qtPopulacao2015 popMun,
u.qtPopulacao2015 popUf,
Round(m.qtPopulacao2015 / u.qtPopulacao2015, 6) rel,
'=',
ssuf.qtPopulacao popUfSebrae,
ssuf.qtPopulacaoRural popRuralUfSebrae,
ssuf.qtPopulacaoUrbana popUrbanaUfSebrae,
'=',
-- ssmu.qtPopulacao,
ssmu.qtPopulacaoRural,
ssmu.qtPopulacaoUrbana,
'=',
ssmu.*
From tbibge_uf u
Inner Join tbibge_municipio m On (u.cdUf = m.cdUf)
Inner Join tbsebraeshop_uf ssuf On (ssuf.cdUf = u.cdUf) And (ssuf.nrAno = 2015)
Inner Join tbsebraeshop_municipio ssmu On (ssmu.cdUf = u.cdUf) And (ssmu.cdMunicipio = m.cdMunicipio) And (ssmu.nrAno = 2015)
Where (u.cdUf = 41)
Order By rel Desc
 * 
 * SQL para verificar tbsebraeshop_municipio_consumo
 * Select
m.cdMunicipioCompleto,
m.qtPopulacao2015 popMun,
u.qtPopulacao2015 popUf,
Round(m.qtPopulacao2015 / u.qtPopulacao2015, 6) rel,
'=',
format(ssuf.varD, 2) varD,
format(ssuf.varE, 2) varE,
'=',
format(ssmu.varD, 2) varD,
format(ssmu.varE, 2) varE
-- ,'=',
-- ssuf.*,
-- ssmu.*
From tbibge_uf u
Inner Join tbibge_municipio m On (u.cdUf = m.cdUf)
Inner Join tbsebraeshop_uf_consumo ssuf On (ssuf.cdUf = u.cdUf) And (ssuf.nrAno = 2015)  And (ssuf.cdCategoria = 1)
Inner Join tbsebraeshop_municipio_consumo ssmu On (ssmu.cdUf = u.cdUf) And (ssmu.cdMunicipio = m.cdMunicipio) And (ssmu.nrAno = 2015) And (ssuf.cdCategoria = ssmu.cdCategoria)
Where (u.cdUf = 41)
Order By rel Desc
 */
class PotencialConsumoMunicipio extends ActionAbstract
{

    public function process(array $params = array())
    {
        $conn = Conexao::getInstance()->getDoctrine();

        $sql = "Delete From tbsebraeshop_municipio Where (nrAno = :nrAno)";

        $conn->executeUpdate($sql, array(
            ':nrAno' => 2015
        ));

        $sql = "Delete From tbsebraeshop_municipio_consumo Where (nrAno = :nrAno)";

        $conn->executeUpdate($sql, array(
            ':nrAno' => 2015
        ));

        $sql = "INSERT INTO tbsebraeshop_municipio
(cdUf, cdMunicipio, nrAno, qtPopulacaoRural, qtPopulacaoUrbana, qtPopulacao, qtDomiciliosRuralTotal, qtDomiciliosUrbanaTotal, qtDomiciliosUrbanaA1, qtDomiciliosUrbanaA2, qtDomiciliosUrbanaB1, qtDomiciliosUrbanaB2, qtDomiciliosUrbanaC1, qtDomiciliosUrbanaC2, qtDomiciliosUrbanaD, qtDomiciliosUrbanaE)
SELECT
    im.cdUf,
    im.cdMunicipio,
    2015,
    Round((ssuf.qtPopulacaoRural / ssuf.qtPopulacao) * im.qtPopulacao2015) qtPopulacaoRural,
    Round((ssuf.qtPopulacaoUrbana / ssuf.qtPopulacao) * im.qtPopulacao2015) qtPopulacaoUrbana,
    im.qtPopulacao2015 qtPopulacao,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosRuralTotal) qtDomiciliosRuralTotal,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaTotal) qtDomiciliosUrbanaTotal,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaA1) qtDomiciliosUrbanaA1,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaA2) qtDomiciliosUrbanaA2,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaB1) qtDomiciliosUrbanaB1,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaB2) qtDomiciliosUrbanaB2,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaC1) qtDomiciliosUrbanaC1,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaC2) qtDomiciliosUrbanaC2,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaD) qtDomiciliosUrbanaD,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssuf.qtDomiciliosUrbanaE) qtDomiciliosUrbanaE
FROM tbibge_municipio im
Inner Join tbsebraeshop_uf ssuf On (ssuf.cdUf = im.cdUf) And (ssuf.nrAno = :nrAno)";

        $conn->executeUpdate($sql, array(
            ':nrAno' => 2015
        ));

        $sql = "INSERT INTO tbsebraeshop_municipio_consumo
(cdUf, cdMunicipio, cdCategoria, nrAno, varA1, varA2, varB1, varB2, varC1, varC2, varD, varE)
Select
    im.cdUf,
    im.cdMunicipio,
    ssufCons.cdCategoria,
    2015 nrAno,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varA1, 2) varA1,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varA2, 2) varA2,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varB1, 2) varB1,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varB2, 2) varB2,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varC1, 2) varC1,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varC2, 2) varC2,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varD, 2) varD,
    Round(im.qtPopulacao2015 / ssuf.qtPopulacao * ssufCons.varE, 2) varE
From tbibge_municipio im
Inner Join tbsebraeshop_uf ssuf
    On (ssuf.cdUf = im.cdUf) And (ssuf.nrAno = :nrAno)
Inner Join tbsebraeshop_uf_consumo ssufCons
    On (ssufCons.cdUf = im.cdUf) And (ssufCons.nrAno = :nrAno)";

        $conn->executeUpdate($sql, array(
            ':nrAno' => 2015
        ));

        $sql = "UPDATE tbsebraeshop_municipio_consumo 
SET varTotal = (varA1 + varA2 + varB1 + varB2 + varC1 + varC2 + varD + varE)";

        $conn->executeUpdate($sql, array());

        $conn->commit();
    }

}
