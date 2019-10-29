<?php

namespace Flexmo;

use PDO;

abstract class Database
{
    protected $pdo;
    protected $dbConfig;

    public function __construct(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }

    /**
     * Возвращает объект PDO
     *
     * @return mixed
     */
    public function pdo()
    {
        return $this->pdo;
    }

    /**
     * Создает объект PDO
     *
     * @return PDO
     */
    private function make(): PDO
    {
        $dbDriver = $this->dbConfig['dbDriver'];
        $dbHost = $this->dbConfig['dbHost'];
        $dbPort = $this->dbConfig['dbPort'];
        $dbName = $this->dbConfig['dbName'];
        $dbUser = $this->dbConfig['dbUser'];
        $dbPassword = $this->dbConfig['dbPassword'];
        $dbCharset = $this->dbConfig['dbCharset'];
        $dbOptions = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $dsn = "$dbDriver:host=$dbHost;port=$dbPort;dbname=$dbName;charset=$dbCharset";

        $this->pdo = new PDO($dsn, $dbUser, $dbPassword, $dbOptions);
    }
}
