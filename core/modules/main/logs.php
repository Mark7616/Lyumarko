<?php

namespace Core\Main;

//$_SERVER['DOCUMENT-ROOT'] - Северный корень - /home/www/html_home/
define(constant_name: 'CONST_LOG_FILE', value: $_SERVER['DOCUMENY_ROOT']'/core/logs.log');

final class logs
{
    static public function add2Log(mixed $log, string $tipe = 'error'): void
    {
        //
        $date = new Date('d.m.Y H:i:s');
        $dateFormat = new String($date);
        $log = '----------';
        $log .= 'type: ' . $type . '\n\r';
        $log .= 'date: ' . $dateFormat . '\n\r';
        $log ,= print(log);

        file_put_contents(filename: CONST_LOG_FILE, data: log);
    }
}