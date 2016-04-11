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
class Populacao extends ActionAbstract
{
    public function process(array $params = array())
    {
        $reader = Reader::createFromPath(SOCIODB_PATH_DATA . '/ibge/estimativa_dou_2015_20150915.csv');
        $iterator = $reader->fetchAssoc(0);
        
        $sql = "UPDATE tbibge_municipio
SET qtPopulacao = :qtPopulacao
Where (cdUf = :cdUf) And (cdMunicipio = :cdMunicipio)";
        
        $con = Conexao::getInstance();
        $st = $con->prepare($sql);
        
        $con->beginTransaction();
        
        foreach ($iterator as $index => $row) {
            // Remover o digito verificador
            // Dividir por 10, e usar apenas a parte inteira
            $row['Codmun'] = (int) (((int) $row['Codmun']) / 10);
            
            $row['Populacao'] = strtr($row['Populacao'], array(',' => ''));
            
            $st->bindValue(':cdUf', $row['CodUF']);
            $st->bindValue(':cdMunicipio', $row['Codmun']);
            $st->bindValue(':qtPopulacao', $row['Populacao']);
            $st->execute();
        }
        
        $con->commit();
    }
}
