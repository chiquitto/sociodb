<?php

namespace Chiquitto\Sociodb;

use Chiquitto\Sociodb\Exception\UndefinedActionException;

/**
 * Description of Sociodb
 *
 * @author chiquitto
 */
class Sociodb
{

    /**
     * 
     * @param string $actionName
     * @param array $options
     * @return Action\ActionAbstract
     * @throws UndefinedActionException
     */
    public static function getActionInstance($actionName, $options = [])
    {
        $actionClass = Action::getActionClass($actionName);
        if ($actionClass === null) {
            throw new UndefinedActionException("Ação indefinida: $actionName");
        }
        
        return new $actionClass;
    }

}
