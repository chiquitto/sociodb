<?php

namespace Chiquitto\Sociodb\Action\Sebraeshop;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;

class PotencialConsumoMunicipio extends ActionAbstract
{
    public function process(array $params = array())
    {
        $conn = Conexao::getInstance()->getDoctrine();
        
        $sql = "Delete From tbsebraeshop_municipio Where (nrAno = :nrAno)";
        
        $conn->executeUpdate($sql, array(
            ':nrAno' => 2015
        ));
        
        return;
        
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
        
        $conn->executeUpdate($sql, array());
        
        $conn->commit();
    }

}
