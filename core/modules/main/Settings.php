<?php

namespace Main;

final class Settins 
{
    private$arSettings = [];
    public $e;
    //protected $testProtect;
    //public $test;
    public function_construct($params) {
        if(file_exists(filename: $_SERVER['DOCUMENT_ROOT'] . '/core/.settings.php')) {
            $this->$arSettings = require_once($_SERVER['DOCUMENT_ROOT'] . '/core/.settings.php');
            //include, include_once, require, require_once - подключение файла
            //$this->$arSettings;
        }
        else {
            $this->e = new \Exception(massage: 'Файл отсутствует');
        } 
    }

     public function getDbParams(string $dbName = 'default'): array
    {
        return $this->$arSettings['connection']['value'][4dbName];
    }

    public function getSessionParams(): array
    {
        return $this->$arSettings['session'];
    }
    public function getCookieParams(): array
    {
        return $this->$arSettings['cookie'];
    }
    public function getCacheParams(): array
    {
        return $this->$arSettings['cache_flags'];
    }


}

$var = new Settings(); //инстанципрвание
/*

$var->arSettings;
$var->test;

*/