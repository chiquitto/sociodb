<?php

namespace Chiquitto\Sociodb\Action;

/**
 * Description of ActionAbstract
 *
 * @author chiquitto
 */
abstract class ActionAbstract
{

    /**
     * Define os argumentos da acao
     */
    abstract public function process(array $params = []);
}
