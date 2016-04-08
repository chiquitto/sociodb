<?php

namespace Chiquitto\Sociodb\Action\Bd;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;

/**
 * Description of Config
 * Ex: ./sociodb.php bd-prepare
 *
 * @author chiquitto
 */
class Prepare extends ActionAbstract
{

    public function process(array $params = array())
    {
        $con = Conexao::getInstance();

        $con->execSqlFile(PATH . '/db/mysql/drop.sql');
        
        $con->execSqlFile(PATH . '/db/mysql/base.sql');
        $con->execSqlFile(PATH . '/db/mysql/ibge.sql');
    }

}
