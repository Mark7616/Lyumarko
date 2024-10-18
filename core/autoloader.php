<?php

spl_autoload_register(callback: function($class); void
{
    //Корневая директория класса
    $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/core/modules/';

    //Получаем относителбный путь к файлу класса
    $relativeClass = str_replace(search: '\\', replace: '/', subject: $class);

    //Полный путь к файлу класса
    $file = $baseDir . $relativeClass . '.php';
    
    //Если файл существует то подключфем его
    if(file_exists(filename: $file)) {
        require $file;
    }
});