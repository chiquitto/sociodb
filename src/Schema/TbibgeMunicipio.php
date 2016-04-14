<?php

namespace Chiquitto\Sociodb\Schema;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;

/**
 * Description of TbibgeMunicipio
 *
 * @author chiquitto
 */
class TbibgeMunicipio extends AbstractTable
{

    protected $tableName = 'tbibge_municipio';

    public function vlAreaColumn()
    {
        $this->addColumn(new Column('vlArea', Type::getType(Type::STRING), [
            'precision' => 9,
            'scale' => 3
        ]));
    }

}
