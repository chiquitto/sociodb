<?php

namespace Chiquitto\Sociodb\Action\Ibge\Censo2010\TrabalhoRendimento;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use PDO;

/**
 * 
 *
 * @author chiquitto
 */
class Rendimento1 extends ActionAbstract
{
    public function process(array $params = array())
    {
        Conexao::getInstance()->exec('Delete From tbibge_censo_rendimento');
        
        $ufRowset = Conexao::getInstance()->query('SELECT cdUf From tbsuf');

        while ($ufRow = $ufRowset->fetch(PDO::FETCH_ASSOC)) {
            $this->processUf($ufRow['cdUf']);
        }
    }
    
    private function processUf($cdUf)
    {
        $file = SOCIODB_PATH_DATA . "/ibge/censo2010/trabalho-rendimento/tabelas-2-1/rendimentos-{$cdUf}.csv";
        
        if (!is_file($file)) {
            die("$file inexistente");
        }
        
        $linhas = file($file);

        $con = Conexao::getInstance();
        $con->beginTransaction();

        $sql = 'INSERT INTO `tbibge_censo_rendimento` (cdUf, cdMunicipio, semrenda, atemeio, entremeioe1, entre1e2, entre2e5, entre5e10, entre10e20, mais20) VALUES (:cdUf, :cdMunicipio, :semrenda, :atemeio, :entremeioe1, :entre1e2, :entre2e5, :entre5e10, :entre10e20, :mais20)';
        $prepared = $con->prepare($sql);

        $inMunicipios = false;
        foreach ($linhas as $linha) {

            if (!$inMunicipios) {
                if (substr($linha, 0, 13) == '"Municípios"') {
                    $inMunicipios = true;
                }
                continue;
            }
            
            $municipio = $this->processarLinhaMunicipio($linha);
            if (!$municipio) {
                break;
            }

            $params = array(
                'cdUf' => $municipio['cdUf'],
                'cdMunicipio' => $municipio['cdMunicipio'],
                'semrenda' => $municipio['semrenda'],
                'atemeio' => $municipio['atemeio'],
                'entremeioe1' => $municipio['entremeioe1'],
                'entre1e2' => $municipio['entre1e2'],
                'entre2e5' => $municipio['entre2e5'],
                'entre5e10' => $municipio['entre5e10'],
                'entre10e20' => $municipio['entre10e20'],
                'mais20' => $municipio['mais20'],
            );

            try {
                $prepared->execute($params);
            } catch (PDOException $exc) {
                print_r($params);
                echo $sql, "\n";
                echo $exc;
                exit;
            }
        }

        $con->commit();
    }
    
    /**
     * Processa uma linha de municipio e retorna um array com os dados
     * 
     * @param string $linha
     */
    private function processarLinhaMunicipio($linha)
    {
        $r = array();

        $linha = str_getcsv($linha);

        if ($linha[0] == '') {
            return false;
        }
        
        $cd = $this->processarNumero($linha[30]);

        $r['cdUf'] = substr($cd, 0, 2);
        $r['cdMunicipio'] = substr($cd, 2, 4);
        // $r['total'] = $this->processarNumero($linha[1]);
        $r['atemeio'] = $this->processarNumero($linha[2]);
        $r['entremeioe1'] = $this->processarNumero($linha[3]);
        $r['entre1e2'] = $this->processarNumero($linha[4]);
        $r['entre2e5'] = $this->processarNumero($linha[5]);
        $r['entre5e10'] = $this->processarNumero($linha[6]);
        $r['entre10e20'] = $this->processarNumero($linha[7]);
        $r['mais20'] = $this->processarNumero($linha[8]);
        $r['semrenda'] = $this->processarNumero($linha[9]);

        return $r;
    }

    private function processarNumero($n)
    {
        return strtr(trim($n), array(
            ' ' => ''
        ));
    }
}
