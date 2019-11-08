<?php

namespace Flexmo;

use App\Configs\AppConfig;
use PDO;

class Database
{
    /** @var PDO $pdo */
    public $pdo;
    protected $dbConfig;
    protected $container;

    public function __construct(AppConfig $appConfig, Container $container)
    {
        $this->dbConfig = $appConfig->getDbConfig();
        $this->container = $container;
    }

    /**
     * Создает объект PDO записываем в свойство объекта
     */
    public function makePdo()
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
        // TODO Разобраться как создать объект с параметрами в конструкторе и положить его в контейнер
        //$this->pdoConnection = $this->container->make(PDO::class, [$dsn, $dbUser, $dbPassword, $dbOptions]);
    }
}
