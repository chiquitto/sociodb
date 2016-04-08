<?php

namespace Chiquitto\Sociodb\Terminal;

/**
 * Description of Action
 *
 * @author chiquitto
 */
class Action
{

    public static function getNamespacedActionClass($actionName)
    {
        $actionClass = \Chiquitto\Sociodb\Action::getActionClass($actionName);
        
        if ($actionClass === null) {
            return null;
        }
        return __NAMESPACE__ . '\\Action\\' . $actionClass;
    }

}
