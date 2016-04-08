<?php

namespace Chiquitto\Sociodb\Terminal\Action;

use Chiquitto\Sociodb\Exception\ArgumentsParseException;
use Chiquitto\Sociodb\Sociodb;
use Chiquitto\Sociodb\Terminal;

/**
 * Description of AbstractAction
 *
 * @author chiquitto
 */
abstract class ActionAbstract
{
    protected $action;

    public function arguments()
    {
        
    }

    public function argumentsParse()
    {
        try {
            Terminal::getInstance()->arguments->parse();
        } catch (Exception $exc) {
            throw new ArgumentsParseException(null, null, $exc);
        }
    }
    
    public function process()
    {
        Sociodb::getActionInstance($this->action, array())->process();
    }

}
