<?php

namespace Chiquitto\Sociodb;

use Chiquitto\Sociodb\Exception\ArgumentsParseException;
use League\CLImate\CLImate;

/**
 * Description of Terminal
 *
 * @author chiquitto
 */
class Terminal extends CLImate
{

    /**
     *
     * @var Terminal
     */
    private static $instance;

    public static function initTerminal()
    {
        self::$instance = new Terminal();

        self::$instance->description("Dados do IBGE disponibilizados em formato SQL");

        self::$instance->arguments->add([
            'action' => [
                'description' => 'Ação a ser executada',
                'required' => true,
            ],
            'help' => [
                'prefix' => 'h',
                'longPrefix' => 'help',
                'description' => 'Ajuda para um action',
                'noValue' => true,
            ],
        ]);

        try {
            self::$instance->arguments->parse();
        } catch (\Exception $exc) {
            throw new ArgumentsParseException(null, null, $exc);
        }
    }

    /**
     * 
     * @return Terminal
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::initTerminal();
        }
        return self::$instance;
    }
    
    public function run()
    {
        (new Terminal\Router())->run();
    }

}
