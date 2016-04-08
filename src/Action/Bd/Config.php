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
            'dsn' => $params['dsn'],
            'user' => $params['user'],
            'pass' => $params['password']
        ];
        
        if (!is_dir(PATH_TMP)) {
            mkdir(PATH_TMP, 0777, true);
        }
        
        file_put_contents(DB_CONFIG, json_encode($content));
    }

}
