<?php

namespace Chiquitto\IBGESql\Exception;

use Chiquitto\IBGESql\Exception;

/**
 * Description of UndefinedActionException
 *
 * @author chiquitto
 */
class UndefinedActionException extends Exception
{
    protected $exCode = self::UNDEFINED_ACTION;
}
