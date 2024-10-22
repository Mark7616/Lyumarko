<?php

namespace Db;

class Application {
    public function __contrust() {

    }
    static public function includeComponent(string $name, string $template, array $arParams) {
        $componentPath = $_SERVER['DOCUMRNT ROOT'] . '/core/components' . $name . '/';

        if($template == '') $template = 'default';
             
        $templatePath = $componentPath . '/function.php'. $template;

        //
        if(file_exists($componentPath . '/function.php')) {
            require $componentPath .  '/function.php';
        }

        //
        if(file_exists($templatePath . '/.paraments.php')) {
            require $templatePath .  '/.paraments.php';
        }

        //
        if(file_exists($templatePath . '/result_modifer.php')) {
            require $templatePath .  '/result_modifer.php';
        }

        Asset::addExternalCss($templatePath . '/style.css');
        Asset::addExternalJs($templatePath . '/script.css');

        //
        if(file_exists($componentPath . '/component.php')) {
            require $componentPath .  '/component.php';
        }
    }
}