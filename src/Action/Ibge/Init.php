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

    public function process(array $params = array())
    {
        Conexao::getInstance()->execSqlFile(SOCIODB_PATH_DATA . '/ibge/init.sql');
    }

}
