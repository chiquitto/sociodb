<?php

namespace Chiquitto\IBGESql\Action\Bd;

use Chiquitto\IBGESql\Action\ActionAbstract;
use Chiquitto\IBGESql\Terminal;

/**
 * Description of Config
 * Ex: ./ibgesql -h bd-config -d "mysql:host=localhost;dbname=ibge" -u root
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
        
        $content = [
            'dsn' => $args['dsn'],
            'user' => $args['user'],
            'pass' => $args['password']
        ];
        
        file_put_contents(DB_CONFIG, json_encode($content));
    }
}
