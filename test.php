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

Sociodb::getActionInstance(Action::ACTION_BD_PREPARE, array())->process();
Sociodb::getActionInstance(Action::ACTION_BD_DATA, array())->process();
Sociodb::getActionInstance(Action::ACTION_IBGE_INIT, array())->process();
Sociodb::getActionInstance(Action::ACTION_IBGE_MUNICIPIO_AREA, array())->process();
Sociodb::getActionInstance(Action::ACTION_IBGE_MUNICIPIO_POPULACAO_2015, array())->process();
exit;
Sociodb::getActionInstance(Action::ACTION_IBGE_CENSO2010_TRABALHO_RENDIMENTO_2_1, array())->process();
Sociodb::getActionInstance(Action::ACTION_IBGE_MUNICIPIO_PIB_2013, array())->process();
Sociodb::getActionInstance(Action::ACTION_IBGE_MUNICIPIO_RENDIMENTO_MEDIO_MENSAL_DOMICILIO_URBANO, array())->process();
