<?php

namespace Chiquitto\Sociodb\Exception;

use Chiquitto\Sociodb\Exception;

/**
 * Description of UndefinedActionException
 *
 * @author chiquitto
 */
class UndefinedActionException extends Exception
{
    protected $exCode = self::UNDEFINED_ACTION;
}
