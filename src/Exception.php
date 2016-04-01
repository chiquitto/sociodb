<?php

namespace Chiquitto\IBGESql;

use Exception as PhpException;

/**
 * Description of Exception
 *
 * @author chiquitto
 */
class Exception extends PhpException
{
    const ARGUMENTS_PARSE_ERROR = '1001';
    const UNDEFINED_ACTION = '2001';
    
    private $defaultMessages = [
        self::ARGUMENTS_PARSE_ERROR => 'Erro para processar os argumentos: {previousMessage}',
    ];

    protected $exCode;

    public function __construct($message = "", $code = 0, PhpException $previous = null)
    {
        $code = $this->exCode;
        
        if ($message == '') {
            $message = $this->getDefaultMessage($code, $previous);
        }
        
        parent::__construct($message, $code, $previous);
    }
    
    private function getDefaultMessage($code = 0, PhpException $previous = null)
    {
        $r = '';
        if (isset($this->defaultMessages[$code])) {
            $r = $this->defaultMessages[$code];
            
            if (isset($previous)) {
                $r = strtr($r, [
                    '{previousMessage}' => $previous->getMessage(),
                ]);
            }
        }
        return $r;
    }
}
