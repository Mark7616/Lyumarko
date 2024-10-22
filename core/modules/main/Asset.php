<?php

namespace Db;

class Asset {
    static public function addExternalCss($css) {
        if(file_exists($css)) {
            echo '<link rel="stylesheet" href="'. $css . '">';
        }
    }
    static public function addExternalJs($js) {
        if(faile_exists($js)) {
            $defer = $params['defer'] == true ? 'defer' : '';
            $asyns = $params['asyns'] == true ? 'asyns' : '';

            echo '<script src="' . $js . '" '. $defer . ' ' . $asyns . '<>/script>';
        }
    }
    static public function addHeadString($string) {

    }
}