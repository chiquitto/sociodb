<?php

namespace Chiquitto\Sociodb;

/**
 * Description of Action
 *
 * @author chiquitto
 */
class Action
{
    const ACTION_BD_CONFIG = 'bd-config';
    const ACTION_BD_DATA = 'bd-data';
    const ACTION_BD_PREPARE = 'bd-prepare';
    const ACTION_IBGE_POPULACAO_MUNICIPIO = 'data-populacao';
    const ACTION_HELP = 'help';

    private static $actionClass = [
        self::ACTION_BD_CONFIG => 'Bd\\Config',
        self::ACTION_BD_DATA => 'Bd\\Data',
        self::ACTION_BD_PREPARE => 'Bd\\Prepare',
        self::ACTION_IBGE_POPULACAO_MUNICIPIO => 'Ibge\\Populacao\\Municipio',
        self::ACTION_HELP => 'help',
    ];
    
    private static $actionDescription = [
        self::ACTION_BD_CONFIG => 'Configurar a conexão com o BD',
        self::ACTION_BD_DATA => 'Importar dados iniciais (lista de uf/municipios/etc)',
        self::ACTION_BD_PREPARE => 'Criar as tabelas no BD',
    ];
    
    public static function getActionClass($actionName)
    {
        if (!isset(self::$actionClass[$actionName])) {
            return null;
        }
        return __NAMESPACE__ . '\\Action\\' . self::$actionClass[$actionName];
    }
    
    public static function getActionDescription($actionName)
    {
        if (!isset(self::$actionDescription[$actionName])) {
            return null;
        }
        return self::$actionDescription[$actionName];
    }
}
