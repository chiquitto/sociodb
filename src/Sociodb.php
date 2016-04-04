<?php

namespace Chiquitto\Sociodb;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Exception\ArgumentsParseException;
use Chiquitto\Sociodb\Exception\UndefinedActionException;

/**
 * Description of Sociodb
 *
 * @author chiquitto
 */
class Sociodb
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
