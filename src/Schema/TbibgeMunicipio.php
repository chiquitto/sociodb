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

    public function qtPopulacao2015Column()
    {
        $this->addColumn(new Column('qtPopulacao2015', Type::getType(Type::INTEGER)));
    }

    public function vlAreaColumn()
    {
        $this->addColumn(new Column('vlArea', Type::getType(Type::DECIMAL), [
            'precision' => 9,
            'scale' => 3
        ]));
    }

    public function vlDensidadeDemografica2015Column()
    {
        $this->addColumn(new Column('vlDensidadeDemografica2015', Type::getType(Type::DECIMAL), [
            'precision' => 7,
            'scale' => 2
        ]));
    }

}
