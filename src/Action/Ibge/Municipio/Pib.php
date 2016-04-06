<?php

namespace Chiquitto\Sociodb\Action\Ibge\Municipio;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use Chiquitto\Sociodb\Terminal;

/**
 * 
 *
 * @author chiquitto
 */
class Pib extends ActionAbstract
{

    public function arguments()
    {
        
    }

    private function parseLine($line)
    {
        $r = [];

        $r['nrAno'] = (int) substr($line, 0, 4);
        $r['cdUf'] = (int) substr($line, 5, 2);
        // pegar um ultimo numero a menos, porque o ultimo eh dv
        $r['cdMunicipio'] = (int) substr($line, 36, 4);
        $r['vlPib'] = (float) substr($line, 401, 18);
        $r['qtPopulacao'] = (int) substr($line, 420, 18);
        $r['vlPibCapita'] = (float) substr($line, 439, 18);

        return $r;
    }

    public function process()
    {
        $filename = PATH_DATA . '/ibge/pib-2010-2013.txt';
        $content = file($filename);

        $sql = "INSERT INTO tbibge_pib_municipio (cdUf, cdMunicipio, nrAno, vlPib, qtPopulacao, vlPibCapita)
            VALUES (:cdUf, :cdMunicipio, :nrAno, :vlPib, :qtPopulacao, :vlPibCapita)";

        $con = Conexao::getInstance();

        $con->exec('Delete From tbibge_pib_municipio');

        $st = $con->prepare($sql);

        $con->beginTransaction();
        
        $progress = Terminal::getInstance()->progress()->total(count($content));
        
        foreach ($content as $line) {
            $line = $this->parseLine($line);
            
            $st->bindValue(':cdUf', $line['cdUf']);
            $st->bindValue(':cdMunicipio', $line['cdMunicipio']);
            $st->bindValue(':nrAno', $line['nrAno']);
            $st->bindValue(':vlPib', $line['vlPib']);
            $st->bindValue(':qtPopulacao', $line['qtPopulacao']);
            $st->bindValue(':vlPibCapita', $line['vlPibCapita']);

            $st->execute();
            
            $progress->advance();
        }
        
        $con->commit();
    }

}
