<?php

namespace Chiquitto\Sociodb;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use PDO;
use PDOException;

/**
 * Classe de Conexao
 *
 * @author alisson
 */
class Conexao extends PDO
{

    private static $dsn;
    private static $dsnValues;
    private static $user;
    private static $password;
    private static $instancia;

    public function __construct()
    {
        $this->loadFile();
        
        try {
            parent::__construct(self::$dsn, self::$user, self::$password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->query('SET NAMES UTF8'); // UTF-8 Mysql
        } catch (PDOException $e) {
            echo "Conexão falhou. Erro: " . $e->getMessage() . "\n";
            exit;
        }
    }
    
    /**
     * 
     * @return \Doctrine\DBAL\Connection
     */
    public function getDoctrineConection()
    {
        $config = new Configuration();
        $connectionParams = array(
            'dbname' => $this->getDsnValue('dbname'),
            'user' => $this->getUser(),
            'password' => $this->getPassword(),
            'host' => $this->getDsnValue('host'),
            'driver' => 'pdo_mysql',
        );
        return DriverManager::getConnection($connectionParams, $config);
    }
    
    public function getDsnValue($key)
    {
        return self::$dsnValues[$key];
    }
    
    public function getPassword()
    {
        return self::$password;
    }
    
    public function getUser()
    {
        return self::$user;
    }

    public static function setConfig($dsn, $user, $password)
    {
        self::$dsn = $dsn;
        self::$user = $user;
        self::$password = $password;
        
        // extract values from dsn
        list($dsnType, $dsnValues) = explode(':', $dsn);
        
        $dsnValuesExploded = explode(';', $dsnValues);
        
        self::$dsnValues = [];
        self::$dsnValues['type'] = $dsnType;
        foreach ($dsnValuesExploded as $dsnValue) {
            $tmp = explode('=', $dsnValue);
            self::$dsnValues[$tmp[0]] = $tmp[1];
        }
    }

    private function loadFile()
    {
        if (self::$dsn === null) {
            $content = file_get_contents(SOCIODB_DB_CONFIG);
            $data = json_decode($content);

            self::setConfig($data->dsn, $data->user, $data->pass);
        }
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

    public function execSqlFile($filename, $delimiter = ';')
    {
        $host = escapeshellarg($this->getDsnValue('host'));
        $user = escapeshellarg(self::$user);
        $pass = escapeshellarg(self::$password);
        $dbname = escapeshellarg($this->getDsnValue('dbname'));
        $filename = escapeshellarg($filename);

        $command = "mysql -h {$host} -u {$user} -p{$pass} -D {$dbname} --default-character-set=utf8 < {$filename}";
        exec($command);

        return true;
    }

}
