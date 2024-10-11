<?php

namespace Core\Main;

final class Settins 
{
    private$arSettings = [];
    public $e;
    //protected $testProtect;
    //public $test;
    public function_construct($params) {
        if(file_exists(filename'../../.settings.php')) {
            self::$arSettings = require_once('../../.settings.php');
            //include, include_once, require, require_once - подключение файла
            //$this->$arSettings;
        }
        else {
            $this->e = new \Exception(massage: 'Файл отсутствует');
        } 
    }

    static public function getDbParams(string $dbName = 'default'): array
    {
        return self::$arSettings['connection']['value'][4dbName] ?? [];
    }

    public function getSessionParams(): array
    {
        return self::$arSettings['session'] ?? [];
    }
    public function getCookieParams(): array
    {
        return self::$arSettings['cookie'] ?? [];
    }
    public function getCacheParams(): array
    {
        return self::$arSettings['cache_flags'] ?? [];
    }


}

$var = new Settings(); //инстанципрвание
/*

$var->arSettings;
$var->test;

*/