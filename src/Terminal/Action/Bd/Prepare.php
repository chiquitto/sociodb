<?php

namespace Chiquitto\Sociodb\Terminal\Action\Bd;

use Chiquitto\Sociodb\Action;
use Chiquitto\Sociodb\Terminal\Action\ActionAbstract;

/**
 * Description of Config
 *
 * @author chiquitto
 * @example ./sociodb.php bd-prepare
 */
class Prepare extends ActionAbstract
{
    protected $action = Action::ACTION_BD_PREPARE;
}
