<?php

namespace Chiquitto\Sociodb\Terminal;

use Chiquitto\Sociodb\Exception;
use Chiquitto\Sociodb\Exception\ArgumentsParseException;
use Chiquitto\Sociodb\Exception\UndefinedActionException;
use Chiquitto\Sociodb\Terminal;
use Chiquitto\Sociodb\Terminal\Action as TerminalAction;
use Chiquitto\Sociodb\Terminal\Action\ActionAbstract;

/**
 * Description of Sociodb
 *
 * @author chiquitto
 */
class Router
{
    
    private function getActionName()
    {
        return Terminal::getInstance()->arguments->get('action');
    }

    public function run()
    {
        $exception = null;
        
        try {
            $this->runAction();
        } catch (UndefinedActionException $exc) {
            $exception = $exc;
        } catch (ArgumentsParseException $exc) {
            $exception = $exc;
        }
        
        if ($exception instanceof Exception) {
            $terminal = Terminal::getInstance();
            $terminal->error('Erro: ' . $exc->getMessage());
        }
        
        if ($exception instanceof UndefinedActionException) {
            $terminal->draw('404');
        }
        if ($exception instanceof ArgumentsParseException) {
            $terminal->usage();
        }
    }

    private function runAction()
    {
        $terminal = Terminal::getInstance();

        $actionName = $this->getActionName();

        $actionClass = TerminalAction::getNamespacedActionClass($actionName);
        if ($actionClass === null) {
            throw new UndefinedActionException("Ação indefinida: $actionName");
        }
        
        /* @var $actionInstance ActionAbstract */
        $actionInstance = new $actionClass;
        $actionInstance->arguments();
        
        if ($terminal->arguments->defined('help')) {
            $terminal->usage();
            return;
        }
        
        $actionInstance->argumentsParse();
        // $terminal->out('');
        $actionInstance->process();
    }

}
