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
 * @example ./sociodb.php bd-config --host localhost -d sociodb -u root -p 123456 -d sociodb
 */
class Config extends ActionAbstract
{

    public function arguments()
    {
        $terminal = Terminal::getInstance();
        $terminal->arguments->add([
            'host' => [
                //'prefix' => 'h',
                'longPrefix' => 'host',
                'description' => 'Host do banco de dados',
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
            'dbname' => [
                'prefix' => 'd',
                'longPrefix' => 'dbname',
                'description' => 'Nome do banco de dados',
                'required' => true,
            ],
        ]);
    }

    public function process()
    {
        $terminal = Terminal::getInstance();
        $args = $terminal->arguments->toArray();

        Sociodb::getActionInstance(Action::ACTION_BD_CONFIG, [])->process([
            'host' => $args['host'],
            'user' => $args['user'],
            'password' => $args['password'],
            'dbname' => $args['dbname'],
        ]);
    }

}
