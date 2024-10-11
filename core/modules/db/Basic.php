<?php

namespace Core\Db;

use Core\Main\Settings;
use PDO;
use PDOException;

class Basic
{
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $dbHost;
    private $conn;

    public function __construct(string $dbName = 'default') {
        $this->dbName = $dbName;
        $arSettings = Setting::getDbParams(dbName: dbName);
        $this->dbHost = $arSettings['host'];
        $this->dbUser = $arSettings['user'];
        $this->dbPassword = $arSettings['password'];

        $this->connect();
    }

    public function connect() : bool
    {
        try {
            $this->coon = new PDO(
                dsn: `mysql:host=$this->dbHost;dbName=$this->dbName`,
                
            )
        }
    }
}