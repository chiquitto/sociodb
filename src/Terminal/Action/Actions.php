<?php

namespace Chiquitto\Sociodb\Terminal\Action;

use Chiquitto\Sociodb\Action;
use Chiquitto\Sociodb\Terminal;
use Chiquitto\Sociodb\Terminal\Action\ActionAbstract;

/**
 * Description of Config
 *
 * @author chiquitto
 * @example ./sociodb.php actions
 */
class Actions extends ActionAbstract
{

    public function process()
    {
        $terminal = Terminal::getInstance();

        $descriptions = Action::getActionDescription();
        foreach($descriptions as $key => $desc) {
            $key = str_pad($key, 30, ' ', STR_PAD_RIGHT);
            $terminal->out("<red>$key</red> => $desc");
        }
    }

}
