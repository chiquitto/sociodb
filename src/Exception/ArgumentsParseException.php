<?php

namespace Chiquitto\Sociodb\Exception;

use Chiquitto\Sociodb\Exception;

/**
 * Description of ArgumentsParseException
 *
 * @author chiquitto
 */
class ArgumentsParseException extends Exception
{
    protected $exCode = self::ARGUMENTS_PARSE_ERROR;
}
