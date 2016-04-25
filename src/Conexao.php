<?php

namespace Chiquitto\Sociodb;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\PDOConnection;
use Doctrine\DBAL\DriverManager;

/**
 * Classe de Conexao
 *
 * @author alisson
 */
class Conexao
{

    private static $config;
    private static $instancia;
    private $doctrine;

    public function __construct()
    {
        if (self::$config === null) {
            $this->loadFile();
        }
    }

    public function execSqlFile($filename, $delimiter = ';')
    {
        $host = escapeshellarg(self::getConfigHost());
        $user = escapeshellarg(self::getConfigUser());
        $pass = escapeshellarg(self::getConfigPassword());
        $dbname = escapeshellarg(self::getConfigDbname());
        $filename = escapeshellarg($filename);

        $command = "mysql -h {$host} -u {$user} -p{$pass} -D {$dbname} --default-character-set=utf8 < {$filename}";
        exec($command);

        return true;
    }

    private static function getConfigDbname()
    {
        return self::$config['dbname'];
    }

    private static function getConfigHost()
    {
        return self::$config['host'];
    }

    private static function getConfigPassword()
    {
        return self::$config['password'];
    }

    private static function getConfigUser()
    {
        return self::$config['user'];
    }

    /**
     * 
     * @return Connection
     */
    public function getDoctrine()
    {
        if ($this->doctrine === null) {
            $config = new Configuration();
            //$config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());
            $config->setAutoCommit(false);
            
            $connectionParams = array(
                'dbname' => self::getConfigDbname(),
                'user' => self::getConfigUser(),
                'password' => self::getConfigPassword(),
                'host' => self::getConfigHost(),
                'driver' => 'pdo_mysql',
            );
            $this->doctrine = DriverManager::getConnection($connectionParams, $config);
        }
        return $this->doctrine;
    }

    /**
     * 
     * @return Conexao
     */
    public static function getInstance()
    {
        if (null === self::$instancia) {
            self::$instancia = new Conexao();
        }
        return self::$instancia;
    }
    
    /**
     * 
     * @return PDOConnection
     */
    public function getPdo()
    {
        return $this->getDoctrine()->getWrappedConnection();
    }

    private function loadFile()
    {
        if (self::$config === null) {
            $content = file_get_contents(SOCIODB_DB_CONFIG);
            $data = json_decode($content, 1);

            self::setConfig($data);
        }
    }

    public static function setConfig($config)
    {
        self::$config = $config;
    }

}
