<?php

namespace Chiquitto\IBGESql\Exception;

use Chiquitto\IBGESql\Exception;

/**
 * Description of ArgumentsParseException
 *
 * @author chiquitto
 */
class ArgumentsParseException extends Exception
{
    protected $exCode = self::ARGUMENTS_PARSE_ERROR;
}
