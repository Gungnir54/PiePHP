<?php

spl_autoload_register(function ($class_name) {

    if (explode('\\', $class_name)[0] == 'Core') {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
        include $class.'.php';
    } else {
        $class = 'src/'.str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
        include $class.'.php';
    }
    // echo "<br>";
    // echo "==>L'Autoload charge ==> ".$class;
});