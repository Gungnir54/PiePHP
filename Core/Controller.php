<?php

namespace Core;

class Controller {

    static $_render;

    public function __construct() {
        $this->requestParams = new \Core\Request;
    }

    public function __destruct() {
        echo self::$_render;
    }
    
    protected function render($view, $scope=[]) {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('\\', '', str_replace('Controller', '', basename(get_class($this)))), $view]).'.php';
        echo $f;
        if(file_exists($f)) {
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']).'.php');
            self::$_render = ob_get_clean();
        }
    }
}
