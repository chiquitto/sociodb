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
        
        $sql = "INSERT INTO tbsebraeshop_municipio
(cdUf, cdMunicipio, nrAno, qtPopulacao, qtDomiciliosTotal,
qtDomiciliosA1, qtDomiciliosA2, qtDomiciliosB1, qtDomiciliosB2, qtDomiciliosC1, qtDomiciliosC2, qtDomiciliosD, qtDomiciliosE)
SELECT
im.cdUf, im.cdMunicipio, 2015 nrAno,
im.qtPopulacao2015 qtPopulacao,
0 qtDomiciliosTotal,
ROUND(ssuf.qtDomiciliosA1 * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosA1,
ROUND(ssuf.qtDomiciliosA2 * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosA2,
ROUND(ssuf.qtDomiciliosB1 * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosB1,
ROUND(ssuf.qtDomiciliosB2 * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosB2,
ROUND(ssuf.qtDomiciliosC1 * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosC1,
ROUND(ssuf.qtDomiciliosC2 * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosC2,
ROUND(ssuf.qtDomiciliosD  * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosD,
ROUND(ssuf.qtDomiciliosE  * (im.qtPopulacao2015 / iu.qtPopulacao2015)) qtDomiciliosE
FROM tbibge_municipio im
Inner Join tbibge_uf iu On (iu.cdUf = im.cdUf)
Inner Join tbsebraeshop_uf ssuf On (ssuf.cdUf = im.cdUf) And (ssuf.nrAno = :nrAno)";
        
        $conn->executeUpdate($sql, array(
            ':nrAno' => 2015
        ));
        
        $sql = "Update tbsebraeshop_municipio
Set qtDomiciliosTotal = (qtDomiciliosA1 + qtDomiciliosA2 + qtDomiciliosB1 + qtDomiciliosB2 + qtDomiciliosC1 + qtDomiciliosC2 + qtDomiciliosD + qtDomiciliosE)";
        
        $conn->executeUpdate($sql, array());
        
        $conn->commit();
    }

}
