<?php

namespace Chiquitto\Sociodb\Action\Ibge\Municipio;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use Doctrine\DBAL\Types\Type;
use PDO;

/**
 * 
 *
 * @author chiquitto
 */
class Area extends ActionAbstract
{

    private $tmpDirPath;
    private $tmpFilePath;

    private function loadFile($cdUf)
    {
        $filePath = strtr($this->tmpFilePath, [
            '{UF}' => $cdUf
        ]);

        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
        } else {
            $url = "http://www.cidades.ibge.gov.br/cartograma/getdata.php?coduf={$cdUf}&idtema=16&codv=V01&nfaixas=4";
            $content = file_get_contents($url);

            // @link http://stackoverflow.com/questions/6941642/php-json-decode-fails-without-quotes-on-key
            // $content = str_replace(array('"', "'"), array('\"', '"'), $content);
            $content = preg_replace('/(\w+):/i', '"\1":', $content);
            
            if (!is_dir($this->tmpDirPath)) {
                mkdir($this->tmpDirPath, 0777, true);
            }
            
            file_put_contents($filePath, $content);
        }

        return $content;
    }

    public function process(array $params = array())
    {
        $this->tmpDirPath = SOCIODB_PATH_TMP . '/ibge/cartograma/v01';
        $this->tmpFilePath = $this->tmpDirPath . '/{UF}.json';

        $conn = Conexao::getInstance()->getDoctrine();
        $ufRowset = $conn->query('SELECT cdUf, stSigla From tbsuf');

        $sql = "Update tbibge_municipio Set vlArea = 0";
        $conn->query($sql);
        $conn->commit();

        while ($ufRow = $ufRowset->fetch(PDO::FETCH_ASSOC)) {
            $this->processUf($ufRow);
        }
    }

    private function processUf($uf)
    {
        $cdUf = $uf['cdUf'];

        $content = $this->loadFile($cdUf);

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
