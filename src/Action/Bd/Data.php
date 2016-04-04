<?php

namespace Chiquitto\IBGESql\Action\Bd;

use Chiquitto\IBGESql\Action\ActionAbstract;
use Chiquitto\IBGESql\Conexao;

/**
 * Description of Config
 *
 * @author chiquitto
 */
class Data extends ActionAbstract
{
    public function arguments()
    {
        
    }
    
    public function process()
    {
        $con = Conexao::getInstance();
        
        $con->execSqlFile(PATH_IBGE . '/bd-data1.sql');
        $con->execSqlFile(PATH_IBGE . '/bd-data2.sql');
        
        $con->execSqlFile(PATH_IBGE . '/bd-data3.sql');
        $con->execSqlFile(PATH_IBGE . '/bd-data4.sql');
        
        $con->execSqlFile(PATH_IBGE . '/bd-data5.sql');
    }
}
