<?php

namespace Chiquitto\IBGESql;

use PDO;
use PDOException;

/**
 * Classe de Conexao
 *
 * @author alisson
 */
class Conexao extends PDO
{

    private $dsn;
    private $user;
    private $password;
    private static $instancia;

    public function __construct()
    {
        $this->loadFile();

        try {
            parent::__construct($this->dsn, $this->user, $this->password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->query('SET NAMES UTF8'); // UTF-8 Mysql
        } catch (PDOException $e) {
            echo "Conexão falhou. Erro: " . $e->getMessage();
            exit;
        }
    }

    private function loadFile()
    {
        if ($this->dsn === null) {
            $content = file_get_contents(DB_CONFIG);
            $data = json_decode($content);

            $this->dsn = $data->dsn;
            $this->user = $data->user;
            $this->password = $data->pass;
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
        $user = escapeshellarg($this->user);
        $pass = escapeshellarg($this->password);
        $dbname = escapeshellarg('ibge');
        $filename = escapeshellarg($filename);

        $command = "mysql -h {$host} -u {$user} -p{$pass} -D {$dbname} --default-character-set=utf8 < {$filename}";
        exec($command);

        return true;
    }

}
