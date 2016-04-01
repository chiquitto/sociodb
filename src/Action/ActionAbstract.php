<?php

namespace Chiquitto\IBGESql\Action;

use Chiquitto\IBGESql\Exception\ArgumentsParseException;
use Chiquitto\IBGESql\Terminal;
use Exception;

/**
 * Description of ActionAbstract
 *
 * @author chiquitto
 */
abstract class ActionAbstract
{

    /**
     * Define os argumentos da acao
     */
    abstract public function arguments();
    abstract public function process();

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
