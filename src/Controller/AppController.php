<?php

namespace Controller;

class AppController extends \Core\Controller {

    function __construct() {
        echo "<br>";
        echo "Je suis dans le AppController";
        echo '<br>';

        $this->requestParams = new \Core\Request;
    }

    public function indexAction() {
        echo __METHOD__ . "[OK]" . PHP_EOL;
    }
}