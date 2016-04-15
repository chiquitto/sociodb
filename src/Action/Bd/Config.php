<?php

namespace Chiquitto\Sociodb\Action\Bd;

use Chiquitto\Sociodb\Action\ActionAbstract;

/**
 * Description of Data
 * Ex: ./sociodb.php bd-data
 *
 * @author chiquitto
 */
class Config extends ActionAbstract
{

    public function process(array $params = [])
    {
        $content = [
            'host' => $params['host'],
            'user' => $params['user'],
            'password' => $params['password'],
            'dbname' => $params['dbname'],
        ];
        
        if (!is_dir(SOCIODB_PATH_TMP)) {
            mkdir(SOCIODB_PATH_TMP, 0777, true);
        }
        
        file_put_contents(SOCIODB_DB_CONFIG, json_encode($content));
    }

}
