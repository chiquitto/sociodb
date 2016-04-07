<?php

namespace Chiquitto\Sociodb;

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

    public static function setConfig($dsn, $user, $password)
    {
        self::$dsn = $dsn;
        self::$user = $user;
        self::$password = $password;
    }

    private function loadFile()
    {
        if (self::$dsn === null) {
            $content = file_get_contents(DB_CONFIG);
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
        $host = escapeshellarg('localhost');
        $user = escapeshellarg(self::$user);
        $pass = escapeshellarg(self::$password);
        $dbname = escapeshellarg('sociodb');
        $filename = escapeshellarg($filename);

        $command = "mysql -h {$host} -u {$user} -p{$pass} -D {$dbname} --default-character-set=utf8 < {$filename}";
        exec($command);

        return true;
    }

}
