<?php

namespace Chiquitto\Sociodb\Action\Ibge\Municipio;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use Chiquitto\Sociodb\Schema\TbibgeMunicipio;
use Doctrine\DBAL\Types\Type;
use PDO;

/**
 * 
 *
 * @author chiquitto
 */
class Area extends ActionAbstract
{

    /**
     * @link http://stackoverflow.com/questions/24679236/tell-doctrine-schematool-not-to-drop-unknown-tables
     */
    public function database()
    {
        $tb = new TbibgeMunicipio();
        $tb->vlAreaColumn();
    }

    public function process(array $params = array())
    {
        $this->database();
        
        $conn = Conexao::getInstance()->getDoctrine();
        $ufRowset = $conn->query('SELECT cdUf, stSigla From tbsuf');
        
        $sql = "Update tbibge_municipio Set vlArea = 0";
        $conn->query($sql);

        while ($ufRow = $ufRowset->fetch(PDO::FETCH_ASSOC)) {
            $this->processUf($ufRow);
        }
    }

    private function processUf($uf)
    {
        $cdUf = $uf['cdUf'];

        $url = "http://www.cidades.ibge.gov.br/cartograma/getdata.php?coduf={$cdUf}&idtema=16&codv=V01&nfaixas=4";
        $content = file_get_contents($url);

        // @link http://stackoverflow.com/questions/6941642/php-json-decode-fails-without-quotes-on-key
        // $content = str_replace(array('"', "'"), array('\"', '"'), $content);
        $content = preg_replace('/(\w+):/i', '"\1":', $content);

        $json = json_decode($content, 1);

        $conn = Conexao::getInstance()->getDoctrine();
        
        $sql = "Update tbibge_municipio
            Set vlArea = :vlArea
            Where (cdUf = :cdUf) And (cdMunicipio = :cdMunicipio)";
        $stmt = $conn->prepare($sql);
        
        foreach ($json['municipios'] as $cdMunicipio => $municipio) {
            // $cdMunicipioOriginal = $cdMunicipio;
            $cdMunicipio = (int) substr($cdMunicipio, 2);

            $municipio['v'] = (float) $municipio['v'];
            if ($municipio['v'] == 0.0) {
                $municipio['v'] = null;
            }

            $stmt->bindValue(':cdUf', (int) $cdUf, Type::INTEGER);
            $stmt->bindValue(':cdMunicipio', $cdMunicipio, Type::INTEGER);
            $stmt->bindValue(':vlArea', (float) $municipio['v'], Type::DECIMAL);

            $stmt->execute();
        }
        
        $conn->commit();
    }

}
