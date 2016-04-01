<?php

namespace Chiquitto\IBGESql;

/**
 * Description of Action
 *
 * @author chiquitto
 */
class Action
{
    const ACTION_CONFIG_BD = 'bd-config';
    const ACTION_HELP = 'help';

    private static $actionClass = [
        self::ACTION_CONFIG_BD => 'Bd\\Config',
        self::ACTION_HELP => 'help',
    ];
    
    public static function getActionClass($actionName)
    {
        if (!isset(self::$actionClass[$actionName])) {
            return null;
        }
        return __NAMESPACE__ . '\\Action\\' . self::$actionClass[$actionName];
    }
}
