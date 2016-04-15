<?php

namespace Chiquitto\Sociodb\Schema;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;

/**
 * Description of TbibgeMunicipio
 *
 * @author chiquitto
 */
class TbibgeUf extends AbstractTable
{

    protected $tableName = 'tbibge_uf';

    public function qtPopulacao2015Column()
    {
        $this->addColumn(new Column('qtPopulacao2015', Type::getType(Type::INTEGER)));
    }

}
