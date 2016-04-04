<?php

namespace Chiquitto\Sociodb\Action\Ibge;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;

/**
 * 
 *
 * @author chiquitto
 */
class Init extends ActionAbstract
{
    public function arguments()
    {
        
    }
    
    public function process()
    {
        Conexao::getInstance()->execSqlFile(PATH_DATA . '/ibge/init.sql');
    }
}
