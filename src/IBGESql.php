<?php

namespace Chiquitto\IBGESql;

use Chiquitto\IBGESql\Action\ActionAbstract;
use Chiquitto\IBGESql\Exception\ArgumentsParseException;
use Chiquitto\IBGESql\Exception\UndefinedActionException;

/**
 * Description of IBGESql
 *
 * @author chiquitto
 */
class IBGESql
{

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
        
        if ($exception instanceof ArgumentsParseException) {
            $terminal->usage();
        }
    }

    private function runAction()
    {
        $terminal = Terminal::getInstance();

        $actionName = $terminal->getActionName();

        if (($actionName == '') && ($terminal->isHelp())) {
            $terminal->usage();
            return;
        }

        $actionClass = Action::getActionClass($actionName);
        if ($actionClass === null) {
            throw new UndefinedActionException("Ação indefinida: $actionName");
        }

        /* @var $actionInstance ActionAbstract */
        $actionInstance = new $actionClass;
        $actionInstance->arguments();
        
        if ($terminal->isHelp()) {
            $terminal->usage();
            return;
        }
        
        $actionInstance->argumentsParse();
        $actionInstance->process();
    }

}
