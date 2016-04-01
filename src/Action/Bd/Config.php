<?php

namespace Chiquitto\IBGESql\Action\Bd;

use Chiquitto\IBGESql\Action\ActionAbstract;
use Chiquitto\IBGESql\Terminal;

/**
 * Description of Config
 *
 * @author chiquitto
 */
class Config extends ActionAbstract
{
    public function arguments()
    {
        $terminal = Terminal::getInstance();
        $terminal->arguments->add([
            'dsn' => [
                'prefix' => 'd',
                'longPrefix' => 'dsn',
                'description' => 'DSN para a conexão',
            ],
        ]);
    }
}
