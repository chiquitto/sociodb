<?php

namespace Chiquitto\Sociodb\Action\Ibge\Municipio;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use League\Csv\Reader;

/**
 * 
 *
 * @author chiquitto
 */
class Populacao2015 extends ActionAbstract
{

    public function process(array $params = array())
    {
        $reader = Reader::createFromPath(SOCIODB_PATH_DATA . '/ibge/estimativa_dou_2015_20150915.csv');
        $iterator = $reader->fetchAssoc(0);
        
        $conn = Conexao::getInstance()->getDoctrine();
        
        $sql = "UPDATE tbibge_municipio SET qtPopulacao2015 = :qtPopulacao Where (cdUf = :cdUf) And (cdMunicipio = :cdMunicipio)";

        $st = $conn->prepare($sql);

        foreach ($iterator as $row) {
            // Remover o digito verificador
            // Dividir por 10, e usar apenas a parte inteira
            $row['Codmun'] = (int) (((int) $row['Codmun']) / 10);

            $row['Populacao'] = strtr($row['Populacao'], array(',' => ''));

            $st->bindValue(':cdUf', (int) $row['CodUF']);
            $st->bindValue(':cdMunicipio', $row['Codmun']);
            $st->bindValue(':qtPopulacao', (int) $row['Populacao']);
            $st->execute();
        }

        $sql = "Update tbibge_municipio Set vlDensidadeDemografica2015 = (qtPopulacao2015/vlArea) Where (NOT vlArea IS NULL)";
        $conn->exec($sql);

        $sql = "Update tbibge_uf iu Set iu.qtPopulacao2015 = (Select Sum(im.qtPopulacao2015) From tbibge_municipio im Where (im.cdUf = iu.cdUf) Group By im.cdUf)";
        $conn->exec($sql);

        $conn->commit();
    }

}
