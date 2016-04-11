<?php

namespace Chiquitto\Sociodb\Action\Bd;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;

/**
 * Description of Data
 * Ex: ./sociodb.php bd-data
 *
 * @author chiquitto
 */
class Data extends ActionAbstract
{

    public function process(array $params = [])
    {
        $con = Conexao::getInstance();

        $con->execSqlFile(SOCIODB_PATH_DATA . '/bd/data1.sql');
        $con->execSqlFile(SOCIODB_PATH_DATA . '/bd/data2.sql');

        $con->execSqlFile(SOCIODB_PATH_DATA . '/bd/data3.sql');
        $con->execSqlFile(SOCIODB_PATH_DATA . '/bd/data4.sql');

        $con->execSqlFile(SOCIODB_PATH_DATA . '/bd/data5.sql');
    }

}
