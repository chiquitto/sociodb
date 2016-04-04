<?php

namespace Chiquitto\Sociodb\Action;

use Chiquitto\Sociodb\Action;
use Chiquitto\Sociodb\Exception\ArgumentsParseException;
use Chiquitto\Sociodb\Terminal;
use Exception;

/**
 * Description of ActionAbstract
 *
 * @author chiquitto
 */
abstract class ActionAbstract
{
    
    protected $actionName;

    /**
     * Define os argumentos da acao
     */
    abstract public function arguments();
    abstract public function process();
    
    public function __construct()
    {
        $terminal = Terminal::getInstance();
        $terminal->description(Action::getActionDescription($terminal->getActionName()));
    }

    public function argumentsParse()
    {
        $terminal = Terminal::getInstance();

        try {
            $terminal->arguments->parse();
        } catch (Exception $exc) {
            throw new ArgumentsParseException(null, null, $exc);
        }
    }

}
