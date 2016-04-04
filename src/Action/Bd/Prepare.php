<?php

namespace Chiquitto\IBGESql\Action\Bd;

use Chiquitto\IBGESql\Action\ActionAbstract;
use Chiquitto\IBGESql\Conexao;

/**
 * Description of Config
 * Ex: ./ibgesql -h bd-prepare -d "mysql:host=localhost;dbname=ibge" -u root
 *
 * @author chiquitto
 */
class Prepare extends ActionAbstract
{

    public function arguments()
    {
        
    }

    public function process()
    {
        $con = Conexao::getInstance();

        $content = file_get_contents(PATH . '/db/mysql/script.sql');
        $sqls = explode('-- separator', $content);

        foreach ($sqls as $sql) {
            try {
                $con->exec(trim($sql));
            } catch (Exception $exc) {
                echo $exc, "\n\n", $sql;
                exit;
            }
        }
    }

}
