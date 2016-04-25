#! /usr/bin/php
<?php
require './vendor/autoload.php';

use Chiquitto\Sociodb\Action;
use Chiquitto\Sociodb\Conexao;
use Chiquitto\Sociodb\Sociodb;

Conexao::setConfig(array(
    'dbname' => 'sociodb',
    'user' => 'root',
    'password' => '123456',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
));

function process($action, $options = []) {
    $start = microtime(true);
    echo "$action\n";
    Sociodb::getActionInstance($action, $options)->process();
    $final = microtime(true) - $start;
    echo "{$final} s\n";
}

process(Action::ACTION_BD_PREPARE);
process(Action::ACTION_BD_DATA);
process(Action::ACTION_SEBRAESHOP_POTENCIAL_CONSUMO);
process(Action::ACTION_IBGE_INIT);
process(Action::ACTION_IBGE_MUNICIPIO_AREA);
process(Action::ACTION_IBGE_MUNICIPIO_POPULACAO_2015);
process(Action::ACTION_IBGE_CENSO2010_TRABALHO_RENDIMENTO_2_1);
process(Action::ACTION_IBGE_MUNICIPIO_PIB_2013);
process(Action::ACTION_IBGE_MUNICIPIO_RENDIMENTO_MEDIO_MENSAL_DOMICILIO_URBANO);
exit;
