<?php

namespace Chiquitto\Sociodb\Schema;

use Chiquitto\Sociodb\Conexao;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Comparator;
use Doctrine\DBAL\Schema\TableDiff;

/**
 * Description of AbstractTable
 *
 * @author chiquitto
 */
abstract class AbstractTable
{

    protected $tableName = 'tbibge_municipio';

    protected function addColumn(Column $column)
    {
        $conn = Conexao::getInstance()->getDoctrineConection();

        $schema = $conn->getSchemaManager();
        $tbibgeMunicipio = $schema->listTableDetails($this->getTableName());

        if (!$tbibgeMunicipio->hasColumn($column->getName())) {
            $tbibgeMunicipio->addColumn($column->getName(), $column->getType()->getName(), [
                'precision' => $column->getPrecision(),
                'scale' => $column->getScale()
            ]);

            $td = new TableDiff($this->getTableName(), [$column]);
            $conn->getSchemaManager()->alterTable($td);
        }
    }

    public function getTableName()
    {
        return $this->tableName;
    }

}
