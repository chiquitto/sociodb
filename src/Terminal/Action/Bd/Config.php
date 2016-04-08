<?php

namespace Chiquitto\Sociodb\Terminal\Action\Bd;

use Chiquitto\Sociodb\Action;
use Chiquitto\Sociodb\Sociodb;
use Chiquitto\Sociodb\Terminal;
use Chiquitto\Sociodb\Terminal\Action\ActionAbstract;

/**
 * Description of Config
 *
 * @author chiquitto
 * @example ./sociodb.php bd-config -d "mysql:host=localhost;dbname=sociodb" -u root
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
                'required' => true,
            ],
            'user' => [
                'prefix' => 'u',
                'longPrefix' => 'user',
                'description' => 'Usuário para a conexão',
                'required' => true,
            ],
            'password' => [
                'prefix' => 'p',
                'longPrefix' => 'password',
                'description' => 'Senha para a conexão',
            ],
        ]);
    }

    public function process()
    {
        $terminal = Terminal::getInstance();
        $args = $terminal->arguments->toArray();

        Sociodb::getActionInstance(Action::ACTION_BD_CONFIG, array())->process([
            'dsn' => $args['dsn'],
            'user' => $args['user'],
            'password' => $args['password']
        ]);
    }

}
