<?php

namespace Chiquitto\Sociodb;

/**
 * Description of Action
 *
 * @author chiquitto
 */
class Action
{

    const ACTION_ACTIONS = 'actions';
    const ACTION_BD_CONFIG = 'bd-config';
    const ACTION_BD_DATA = 'bd-data';
    const ACTION_BD_PREPARE = 'bd-prepare';
    const ACTION_IBGE_CENSO2010_TRABALHO_RENDIMENTO_2_1 = 'ibge-censo2010-rendimento1';
    const ACTION_IBGE_INIT = 'ibge-init';
    const ACTION_IBGE_MUNICIPIO_AREA = 'ibge-municipio-area';
    const ACTION_IBGE_MUNICIPIO_PIB = 'ibge-municipio-pib';
    const ACTION_IBGE_MUNICIPIO_POPULACAO = 'ibge-municipio-populacao';
    const ACTION_IBGE_MUNICIPIO_RENDIMENTO_MEDIO_MENSAL_DOMICILIO_URBANO = 'ibge-municipio-rendimento-medio-mensal-domicio-urbano';
    const ACTION_HELP = 'help';

    private static $actionClass = [
        self::ACTION_ACTIONS => 'Actions',
        self::ACTION_BD_CONFIG => 'Bd\\Config',
        self::ACTION_BD_DATA => 'Bd\\Data',
        self::ACTION_BD_PREPARE => 'Bd\\Prepare',
        self::ACTION_IBGE_CENSO2010_TRABALHO_RENDIMENTO_2_1 => 'Ibge\\Censo2010\\TrabalhoRendimento\\Rendimento1',
        self::ACTION_IBGE_INIT => 'Ibge\\Init',
        self::ACTION_IBGE_MUNICIPIO_AREA => 'Ibge\\Municipio\\Area',
        self::ACTION_IBGE_MUNICIPIO_PIB => 'Ibge\\Municipio\\Pib',
        self::ACTION_IBGE_MUNICIPIO_POPULACAO => 'Ibge\\Municipio\\Populacao',
        self::ACTION_IBGE_MUNICIPIO_RENDIMENTO_MEDIO_MENSAL_DOMICILIO_URBANO => 'Ibge\\Municipio\\RendimentoMedioMensalDomicilioUrbano',
        self::ACTION_HELP => 'Help',
    ];
    private static $actionDescription = [
        self::ACTION_ACTIONS => 'Exibe a lista de ações',
        self::ACTION_BD_CONFIG => 'Configurar a conexão com o BD',
        self::ACTION_BD_DATA => 'Importar dados iniciais (lista de uf/municipios/etc)',
        self::ACTION_BD_PREPARE => 'Criar as tabelas no BD',
        self::ACTION_IBGE_CENSO2010_TRABALHO_RENDIMENTO_2_1 => 'Censo 2010 - Trabalho e Rendimento - Rendimento - Pessoas de 10 anos ou mais de idade, por condição de atividade na semana de referência e as classes de rendimento nominal mensal, segundo as mesorregiões, as microrregiões e os municípios',
        self::ACTION_IBGE_INIT => 'Inicializar dados para IBGE',
        self::ACTION_IBGE_MUNICIPIO_AREA => 'Atualizar PIB por municipio (IBGE)',
        self::ACTION_IBGE_MUNICIPIO_PIB => 'Atualizar PIB por municipio (IBGE)',
        self::ACTION_IBGE_MUNICIPIO_POPULACAO => 'Atualizar população por municipio (IBGE)',
        self::ACTION_IBGE_MUNICIPIO_RENDIMENTO_MEDIO_MENSAL_DOMICILIO_URBANO => 'Atualizar Valor do rendimento nominal médio mensal dos domicílios particulares permanentes com rendimento domiciliar, por situação do domicílio - Urbana (IBGE)',
    ];
    private static $actionAll = [
        self::ACTION_BD_DATA,
        self::ACTION_IBGE_INIT,
        self::ACTION_IBGE_MUNICIPIO_AREA,
        self::ACTION_IBGE_MUNICIPIO_POPULACAO,
        self::ACTION_IBGE_CENSO2010_TRABALHO_RENDIMENTO_2_1,
        self::ACTION_IBGE_MUNICIPIO_PIB,
        self::ACTION_IBGE_MUNICIPIO_RENDIMENTO_MEDIO_MENSAL_DOMICILIO_URBANO,
    ];

    public static function getActionClass($actionName = null)
    {
        if (!isset(self::$actionClass[$actionName])) {
            return null;
        }
        return self::$actionClass[$actionName];
    }

    public static function getActionDescription($actionName = null)
    {
        if ($actionName === null) {
            return self::$actionDescription;
        }
        if (!isset(self::$actionDescription[$actionName])) {
            return null;
        }
        return self::$actionDescription[$actionName];
    }

    public static function getNamespacedActionClass($actionName)
    {
        if (!isset(self::$actionClass[$actionName])) {
            return null;
        }
        return __NAMESPACE__ . '\\Action\\' . self::$actionClass[$actionName];
    }

}
