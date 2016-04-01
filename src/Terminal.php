<?php

namespace Chiquitto\IBGESql;

use Chiquitto\IBGESql\Exception\ArgumentsParseException;
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
                //'prefix' => 'a',
                //'longPrefix' => 'action',
                'description' => 'Ação a ser executada',
                //'defaultValue' => 'help',
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

    public function isHelp()
    {
        return $this->arguments->defined('help');
    }

    public function getActionName()
    {
        return $this->arguments->get('action');
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

}
